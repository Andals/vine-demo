<?php
namespace Vdemo\Controller\Front;

class Index extends \Vine\Component\Controller\Base
{/*{{{*/
    public function index()
    {/*{{{*/
        $this->assign('uri', $this->request->getUri());
        $this->assign('queryString', $this->request->getQueryString());
    }/*}}}*/
}/*}}}*/
