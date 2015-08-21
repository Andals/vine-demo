<?php
/**
* @file PageObj.php
* @author ligang
* @date 2015-04-28
 */

namespace Vdemo\Lib;

/**
    * Page for view
 */
class PageObj
{/*{{{*/
    const DEF_ROW_NUM  = 20;
    const DEF_LINK_NUM = 10;

    const DEF_PAGENO_PARAM = 'pageno';

    private $rowCnt  = 0;
    private $linkCnt = 0;

    private $pageno     = 0;
    private $totalRows  = 0;
    private $totalPages = 0;

    private $labels  = array();

    public function __construct($pageno, $totalRows, $rowCnt=self::DEF_ROW_NUM, $linkCnt=self::DEF_LINK_NUM)
    {/*{{{*/
        $this->rowCnt  = $rowCnt;
        $this->linkCnt = $linkCnt;

        $this->initPage($pageno, $totalRows);
    }/*}}}*/
    public function initPage($pageno, $totalRows)
    {/*{{{*/
        if ($pageno == 0) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_COMMON_INVALID_PAGENO);
        }

        $this->totalRows = $totalRows;
        if ($this->totalRows == 0) {
            $this->totalPages = 1;
            $this->pageno     = 1;
        } else {
            $this->totalPages = intval(ceil($this->totalRows / $this->rowCnt));
            if ($pageno > $this->totalPages) {
                throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_COMMON_INVALID_PAGENO);
            }
            $this->pageno = $pageno;
        }
    }/*}}}*/

    public function getRowBgn()
    {/*{{{*/
        return ($this->pageno - 1) * $this->rowCnt;
    }/*}}}*/
    public function getRowCnt()
    {/*{{{*/
        return $this->rowCnt;
    }/*}}}*/
    public function getTotalPages()
    {/*{{{*/
        return $this->totalPages;
    }/*}}}*/
    public function getTotalRows()
    {/*{{{*/
        return $this->totalRows;
    }/*}}}*/

    public function curPage()
    {/*{{{*/
        return $this->pageno;
    }/*}}}*/
    public function prePage()
    {/*{{{*/
        return $this->pageno - 1;
    }/*}}}*/
    public function nextPage()
    {/*{{{*/
        return $this->pageno + 1;
    }/*}}}*/
    public function havePre()
    {/*{{{*/
        return ($this->pageno > 1) ? true : false;
    }/*}}}*/
    public function haveNext()
    {/*{{{*/
        return ($this->pageno < $this->totalPages) ? true : false;
    }/*}}}*/

    public function getLables()
    {/*{{{*/
        $bgn = 0;
        $end = 0;
        if ($this->linkCnt > $this->totalPages) {
            $bgn = 1;
            $end = $this->totalPages;
        } else {
            $offset = round($this->linkCnt / 2);
            $bgn    = $this->pageno - $offset;
            if ($bgn < 1) {
                $bgn = 1;
            }

            $end = $bgn + $this->linkCnt - 1;
            if ($end > $this->totalPages) {
                $end = $this->totalPages;
                $bgn = $end - $this->linkCnt + 1;
            }
        }

        $result = array();
        for ($i = $bgn; $i <= $end; $i++) {
            $result[] = $i;
        }
        return $result;
    }/*}}}*/
    public function getPageData($curUrl, $pagenoParam=self::DEF_PAGENO_PARAM)
    {/*{{{*/
        $urlData = explode('?', $curUrl);
        if (isset($urlData[1])) {
            $urlData[1] = preg_replace("/&?$pagenoParam=[^&]*/", '', $urlData[1]);
        }

        $result = array(
            'cur'   => $this->curPage(),
            'first' => $this->makePageUrl(1, $urlData, $pagenoParam),
            'last'  => $this->makePageUrl($this->getTotalPages(), $urlData, $pagenoParam),
            'total_pages' => $this->getTotalPages(),
            'total_rows'  => $this->getTotalRows(),
        );

        if ($this->havePre()) {
            $result['pre'] = $this->makePageUrl($this->prePage(), $urlData, $pagenoParam);
        }
        if ($this->haveNext()) {
            $result['next'] = $this->makePageUrl($this->nextPage(), $urlData, $pagenoParam);
        }

        foreach ($this->getLables() as $pageno) {
            $result['lables'][] = array(
                'no'  => $pageno,
                'url' => $this->makePageUrl($pageno, $urlData, $pagenoParam),
            );
        }

        return $result;
    }/*}}}*/

    private function makePageUrl($pageno, $urlData, $pagenoParam)
    {/*{{{*/
        $result = $urlData[0];
        $result.= "?$pagenoParam=$pageno";
        if (isset($urlData[1]) && '' != $urlData[1]) {
            $urlData[1] = preg_replace('/^&/', '', $urlData[1]);
            $result.= "&$urlData[1]";
        }
        return $result;
    }/*}}}*/
}/*}}}*/
