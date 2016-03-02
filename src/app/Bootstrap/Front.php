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
        // init simple view or smarty view
        $this->initView($container);
        //$this->initSmartyView($container);  
    }/*}}}*/


    private function initView($container)
    {/*{{{*/
        $view = new \Vine\Component\View\Simple();
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');

        $container->setView($view);
    }/*}}}*/
    
    private function initSmartyView($container)
    {/*{{{*/
        $smarty = new \Smarty();
        $smarty->setCompileDir(\Vdemo\ServerConf::getTmpRoot().'/compile');
        $view = new \Vdemo\Lib\View\Smarty($smarty);
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');
    
        $container->setView($view);
    }/*}}}*/
}/*}}}*/
