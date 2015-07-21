<?php
namespace Vdemo\Controller\Front;

class Index extends \Vine\Component\Controller\Base
{/*{{{*/
    public function index()
    {/*{{{*/
        $body = 'uri: '.$this->request->getUri().' ';
        $body.= 'queryString: '.$this->request->getQueryString();

        $this->response->setBody($body);
        $this->response->send();
    }/*}}}*/
}/*}}}*/
