<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/5
 * Time: 14:04
 */
class Page
{
    const placeholder = '__PAGE__';
    private $pageNumber;
    private $pageSize;
    private $totalSize;
    private $totalPages;
    private $urlRule;

    /**
     * @param int $pageNumber
     * @param int $pageSize
     */
    public function __construct($pageNumber = 1, $pageSize = 10)
    {
        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
    }

    /**
     * @param int $size
     *
     * @return int
     */
    public function totalSize($size = null)
    {
        if ($size === null) {
            return $this->totalSize;
        }
        $this->totalSize = $size;
        $this->totalPages = ceil($this->totalSize / $this->pageSize);
        return 0;
    }

    /**
     * @param int $num
     *
     * @return int
     */
    public function pageNumber($num = null)
    {
        if ($num === null) {
            return $this->pageNumber;
        }
        $this->pageNumber = $num;
        return 0;
    }

    /**
     * @param int $size
     *
     * @return int
     */
    public function pageSize($size = null)
    {
        if ($size === null) {
            return $this->pageSize;
        }
        $this->pageSize = $size;
        return 0;
    }

    public function setUrl($url)
    {
        $this->urlRule = $url;
    }

    public function show()
    {
        $str = '';
        if ($this->totalPages != 1) {
            for ($i = 1; $i <= $this->totalPages; $i++) {
                if ($i == $this->pageNumber) {
                    $str .= "<li class=\"page active\"><a>$i</a></li>";
                } elseif ($i <= $this->pageNumber - 6 && $i != 1) {
                    $str .= "<li class=\"page\"><span>...</span></li>";
                    $i = $this->pageNumber - 6;
                } elseif ($i >= $this->pageNumber + 6 && $i != $this->totalPages) {
                    $str .= "<li class=\"page\"><span>...</span></li>";
                    $i = $this->totalPages - 1;
                } else {
                    $str .= "<li class=\"page\">" . $this->getLink($i, $i) . "</li>";
                }
            }
        }
        echo "<div class=\"pager_container\"><ul class=\"pagination\">{$str}</ul></div>";
    }

    private function getLink($pageNum, $words)
    {
        $url = str_replace(self::placeholder, $pageNum, $this->urlRule);
        return "<a href=\"{$url}\">{$words}</a>";
    }

    private function pre($words)
    {
        if ($this->pageNumber != 1) {
            return $this->getLink($this->pageNumber - 1, $words);
        }
        return '';
    }

    private function next($words)
    {
        if ($this->pageNumber < $this->totalPages) {
            return $this->getLink($this->pageNumber + 1, $words);
        }
        return '';
    }

    private function first($name)
    {
        if ($this->pageNumber > 6) {
            return $this->getLink('1', $name);
        }
        return '';
    }

    private function last($name)
    {
        if ($this->pageNumber < $this->totalPages - 6) {
            return $this->getLink($this->totalPages, $name);
        }
        return '';
    }
}
