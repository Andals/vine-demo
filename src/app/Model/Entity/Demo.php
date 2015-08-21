<?php
/**
* @file Demo.php
* @author ligang
* @date 2015-08-21
 */

namespace Vdemo\Model\Entity;

class Demo extends Base
{/*{{{*/
    protected function initPrivateColumns()
    {/*{{{*/
        $this->columns['name'] = '';
    }/*}}}*/

    protected function setPrivateColumnsValidatorConf($conf)
    {/*{{{*/
        $this->setColumnNameValidatorConf($conf);
    }/*}}}*/


    private function setColumnNameValidatorConf($conf)
    {/*{{{*/
        $name = 'name';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, '');

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'strNotNull', ), array(20));
        $conf->setParamExceptionParams($name, 'name不正确或过长', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_NAME);
    }/*}}}*/
}/*}}}*/
