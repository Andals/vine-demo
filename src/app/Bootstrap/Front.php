<?php
/**
* @file Front.php
* @author ligang
* @version 1.0
* @date 2015-07-07
 */

namespace Vdemo\Bootstrap;

/**
    * This is front bootstrap
 */
class Front extends \Vine\Component\Bootstrap\Base
{/*{{{*/
    protected function initView(\Vine\Component\Loader\WebApp $loader)
    {/*{{{*/
        $view = new \Vine\Component\View\Simple();
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');

        $loader->setView($view);
    }/*}}}*/
}/*}}}*/
