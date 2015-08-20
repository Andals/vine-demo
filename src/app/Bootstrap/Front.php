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
        $this->initRouter($container);
        $this->initView($container);
    }/*}}}*/


    private function initRouter($container)
    {/*{{{*/
        $router = $container->getRouter();

        $route = new \Vine\Component\Routing\Route\General();
        $route->setControllerName('index')->setActionName('index');
        $router->addRoute(new \Vine\Component\Routing\Rule\Prefix('/demo/index'), $route);

        $route = new \Vine\Component\Routing\Route\General();
        $route->setControllerName('index')->setActionName('api');
        $router->addRoute(new \Vine\Component\Routing\Rule\Regex('#^/[a-z]+/([0-9]+)$#'), $route);
    }/*}}}*/
    private function initView($container)
    {/*{{{*/
        $view = new \Vine\Component\View\Simple();
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');

        $container->setView($view);
    }/*}}}*/
}/*}}}*/
