<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\InjectionFilter;

use Core\Env;
use Core\Event;
use Core\PluginInterface;

/**
 * 注入过滤
 * @package Plugin\InjectionFilter
 */
class Plugin implements PluginInterface
{

    private static $ignoreKeyArr = ["contents","template"];

    //get拦截规则
    private static $getfilter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    //post拦截规则
    private static $postfilter = "<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    //cookie拦截规则
    private static $cookiefilter = "benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

    /**
     * @return mixed|void
     */
    public static function register()
    {
        Event::attach('CORE.REQUEST.INIT', function () {

            foreach ($_GET as $key => $value) {
                self::stopAttack($key, $value, self::$getfilter);
            }
            foreach ($_POST as $key => $value1) {
                self::stopAttack($key, $value1, self::$postfilter);
            }
            foreach ($_COOKIE as $key => $value2) {
                self::stopAttack($key, $value2, self::$cookiefilter);
            }
        });
    }

    /**
     * 攻击检查拦截
     * @param $strFiltKey
     * @param $strFiltValue
     * @param $arrFiltReq
     * @throws
     */
    private static function stopAttack($strFiltKey, $strFiltValue, $arrFiltReq)
    {
        $strFiltValueStr = $strFiltKey . self::arrForeach($strFiltValue);
        if (preg_match("/" . $arrFiltReq . "/is", $strFiltValueStr) == 1) {
            throw new \Exception("INJECTION FILTER:" . Env::get('PATH_INFO'), 661);
        }
    }

    /**
     * 参数拆分
     * @param $arr
     * @return string
     */
    private static function arrForeach($arr)
    {
        $str = [];

        if (!is_array($arr)) {
            return $arr;
        }

        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $str[] = self::arrForeach($val);
            } else {
                if(in_array($key,self::$ignoreKeyArr)){
                    continue;
                }
                $val = trim($val);
                $str[] = $key . $val;
            }
        }

        return implode($str);
    }
}