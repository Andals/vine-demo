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
class Front extends \Vine\Component\Bootstrap\Web
{/*{{{*/
    protected function initView(\Vine\Component\Container\Web $container)
    {/*{{{*/
        $view = new \Vine\Component\View\Simple();
        $view->setViewRoot(\Vdemo\ServerConf::getViewRoot());
        $view->setViewSuffix('php');

        $container->setView($view);
    }/*}}}*/
    protected function initRouter(\Vine\Component\Container\Web $container)
    {/*{{{*/
        $router = $container->getRouter();

        $route = new \Vine\Component\Routing\Route\General();
        $route->setControllerName('index')->setActionName('index');
        $router->addRoute(new \Vine\Component\Routing\Rule\Prefix('/abc/bcd'), $route);

        $route = new \Vine\Component\Routing\Route\General();
        $route->setControllerName('index')->setActionName('api');
        $router->addRoute(new \Vine\Component\Routing\Rule\Regex('#^/[a-z]+/([0-9]+)$#'), $route);
    }/*}}}*/
}/*}}}*/
