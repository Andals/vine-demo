<?php
namespace Vdemo\Controller\Task;

class DemoController extends \Vine\Component\Controller\BaseController
{/*{{{*/
    public function printAction()
    {/*{{{*/
        var_dump($this->actionParams);
    }/*}}}*/

    protected function setPrintActionParamsConf($conf)
    {/*{{{*/
        $this->setParamFlushNum($conf);
        $this->setParamExitNum($conf);
    }/*}}}*/


    private function setParamId($conf)
    {/*{{{*/
        $name = 'id';
        
        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_NUM);
        $conf->setParamDefaultValue($name, 0);
        
        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'numNotZero'));
        $conf->setParamExceptionParams($name, 'id不正确', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_ID);
    }/*}}}*/
    private function setParamName($conf)
    {/*{{{*/
        $name = 'name';
        
        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, '');
        
        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'strNotNull'));
        $conf->setParamExceptionParams($name, 'name不正确', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_NAME);
    }/*}}}*/
}/*}}}*/
