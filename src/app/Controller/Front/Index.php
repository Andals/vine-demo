<?php
namespace Vdemo\Controller\Front;

class Index extends \Vine\Component\Controller\Base
{/*{{{*/
    public function index()
    {/*{{{*/
        $this->assign('urlPath', $this->request->getUrlPath());

        return $this->autoRender();
    }/*}}}*/
}/*}}}*/
