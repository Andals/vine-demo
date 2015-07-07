<?php
namespace Vdemo\Controller\Front;

class Index extends \Vine\Controller\Base
{/*{{{*/
    public function indexAction($request)
    {/*{{{*/
        var_dump($request->getUri(), $request->getQueryString());
    }/*}}}*/
}/*}}}*/
