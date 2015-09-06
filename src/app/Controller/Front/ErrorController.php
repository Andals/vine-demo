<?php
namespace Vdemo\Controller\Front;

class ErrorController extends \Vine\Component\Controller\BaseController
{/*{{{*/
    public function indexAction($e)
    {/*{{{*/
        return \Vdemo\Lib\ApiResponseFactory::getErrorResponse($e, $this->request);
    }/*}}}*/
}/*}}}*/
