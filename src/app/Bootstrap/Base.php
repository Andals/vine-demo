<?php
/**
* @file Base.php
* @author ligang
* @version 1.0
* @date 2015-08-19
 */

namespace Vdemo\Bootstrap;

/**
    * This is bootstrap base
 */
abstract class Base extends \Vine\Framework\Bootstrap\Web
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
}/*}}}*/
