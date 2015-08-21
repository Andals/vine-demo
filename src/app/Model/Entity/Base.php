<?php
/**
* @file Base.php
* @author ligang
* @date 2015-08-21
 */

namespace Vdemo\Model\Entity;

/**
    * Entity base
 */
abstract class Base extends \Vine\Component\Mysql\Entity\Base
{/*{{{*/
    abstract protected function initPrivateColumns();
    abstract protected function setPrivateColumnsValidatorConf($conf);

    protected function initColumns()
    {/*{{{*/
        $this->initPublicColumns();
        $this->initPrivateColumns();
    }/*}}}*/
    protected function setColumnsValidatorConf($conf)
    {/*{{{*/
        $this->setPublicColumnsValidatorConf($conf);
        $this->setPrivateColumnsValidatorConf($conf);
    }/*}}}*/

    protected function initPublicColumns()
    {/*{{{*/
        $this->columns['id']        = 0;
        $this->columns['add_time']  = '';
        $this->columns['edit_time'] = '';
    }/*}}}*/
    protected function setPublicColumnsValidatorConf($conf)
    {/*{{{*/
        $this->setColumnIdValidatorConf($conf);
        $this->setColumnAddTimeValidatorConf($conf);
        $this->setColumnEditTimeValidatorConf($conf);
    }/*}}}*/

    protected function setColumnIdValidatorConf($conf)
    {/*{{{*/
        $name = 'id';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_NUM);
        $conf->setParamDefaultValue($name, 0);

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'numNotZero'));
        $conf->setParamExceptionParams($name, 'id不正确', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_ID);
    }/*}}}*/
    protected function setColumnAddTimeValidatorConf($conf)
    {/*{{{*/
        $name = 'add_time';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, '');

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'validDateFormat'));
        $conf->setParamExceptionParams($name, 'add_time不正确', \Vdemo\Lib\Error\Errno::E_COMMON_INVALID_ADD_TIME);
    }/*}}}*/
    protected function setColumnEditTimeValidatorConf($conf)
    {/*{{{*/
        $name = 'edit_time';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, '');

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'validDateFormat'));
        $conf->setParamExceptionParams($name, 'edit_time不正确', \Vdemo\Lib\Error\Errno::E_COMMON_INVALID_EDIT_TIME);
    }/*}}}*/
}/*}}}*/
