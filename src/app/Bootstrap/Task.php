<?php
/**
* @file Api.php
* @author ligang
* @version 1.0
* @date 2015-07-07
 */

namespace Huajiao\Bootstrap;

/**
    * This is api bootstrap
 */
class Task extends \Vine\Framework\Bootstrap\Task
{/*{{{*/
    public function __construct($moduleName = '')
    {/*{{{*/
        if ($moduleName == '') {
            $clsName    = get_class($this);
            $pos        = strrpos($clsName, '\\');
            $moduleName = substr($clsName, $pos + 1);
        }

        \Huajiao\AppContainer::getInstance()->setModuleName($moduleName);
    }/*}}}*/

    /**
        * {@inheritdoc}
     */
    public function boot(\Vine\Component\Container\Task $container)
    {/*{{{*/
    }/*}}}*/
}/*}}}*/
