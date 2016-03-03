<?php
namespace Vdemo\Bootstrap;

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

        \Vdemo\AppContainer::getInstance()->setModuleName($moduleName);
    }/*}}}*/

    /**
        * {@inheritdoc}
     */
    public function boot(\Vine\Component\Container\Task $container)
    {/*{{{*/
    }/*}}}*/
}/*}}}*/
