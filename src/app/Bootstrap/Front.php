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
class Front extends Base
{/*{{{*/

    /**
        * {@inheritdoc}
     */
    public function boot(\Vine\Component\Container\Web $container)
    {/*{{{*/
        $this->initView($container);
    }/*}}}*/


    private function initView($container)
    {/*{{{*/
        $view = new \Vine\Component\View\Simple();
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');

        $container->setView($view);
    }/*}}}*/
}/*}}}*/
