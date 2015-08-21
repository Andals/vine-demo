<?php
namespace Vdemo\Controller\Front;

class Error extends \Vine\Component\Controller\Base
{/*{{{*/
    public function index($e)
    {/*{{{*/
        return \Vdemo\Lib\ApiResponseFactory::getErrorResponse($e, $this->request);
    }/*}}}*/
}/*}}}*/
