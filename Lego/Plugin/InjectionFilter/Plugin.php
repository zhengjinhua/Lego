<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\InjectionFilter;

use Filter;
use Core\Event;
use Core\PluginInterface;

/**
 * 注入过滤
 * @package Plugin\InjectionFilter
 */
class Plugin implements PluginInterface
{

    //get拦截规则
    private static $getfilter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    //post拦截规则
    private static $postfilter = "<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    //cookie拦截规则
    private static $cookiefilter = "benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

    public static function register()
    {
        Event::attach('CORE.REQUEST.INIT', function () {
            //xss
            if ($_GET) {
                $_GET = Filter::filterVarArray($_GET, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if ($_POST) {
                $_POST = Filter::filterVarArray($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if ($_COOKIE) {
                $_COOKIE = Filter::filterVarArray($_COOKIE, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            foreach ($_GET as $key => $value) {
                self::stopAttack($key, $value, self::$getfilter);
            }
            foreach ($_POST as $key => $value) {
                self::stopAttack($key, $value, self::$postfilter);
            }
            foreach ($_COOKIE as $key => $value) {
                self::stopAttack($key, $value, self::$cookiefilter);
            }
        });
    }

    /**
     * 攻击检查拦截
     * @param $StrFiltKey
     * @param $StrFiltValue
     * @param $ArrFiltReq
     */
    private static function stopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq)
    {
        $StrFiltValue = self::arrForeach($StrFiltValue);
        if (preg_match("/" . $ArrFiltReq . "/is", $StrFiltValue) == 1 || preg_match("/" . $ArrFiltReq . "/is", $StrFiltKey) == 1) {
            throw new \Exception("INJECTION FILTER:{$_SERVER['PATH_INFO']} {$StrFiltKey} {$StrFiltValue}", 661);
        }
    }

    /**
     * 参数拆分
     * @param $arr
     * @return string
     */
    private static function arrForeach($arr)
    {
        static $str;
        static $keystr;
        if (!is_array($arr)) {
            return $arr;
        }
        foreach ($arr as $key => $val) {
            $keystr = $keystr . $key;
            if (is_array($val)) {
                self::arrForeach($val);
            } else {
                $str[] = $val . $keystr;
            }
        }
        return implode($str);
    }
}