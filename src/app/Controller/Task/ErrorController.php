<?php
namespace Huajiao\Controller\Task;

class ErrorController extends \Vine\Component\Controller\BaseController
{/*{{{*/
    public function indexAction($e)
    {/*{{{*/
        echo 'Errno: '.$e->getCode()."\n";
        echo 'Msg: '.$e->getMessage()."\n";
    }/*}}}*/
}/*}}}*/
