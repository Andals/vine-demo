<?php
namespace Vdemo\Controller\Front;

class IndexController extends \Vine\Component\Controller\BaseController
{/*{{{*/
    public function indexAction()
    {/*{{{*/
        $this->assign('urlPath', $this->request->getUrlPath());

        return $this->autoRender();
    }/*}}}*/
}/*}}}*/
