<?php
/**
* @file Demo.php
* @author ligang
* @date 2015-08-24
 */

namespace Vdemo\Model\Dao;

/**
    * Demo dao
 */
class Demo extends Base
{/*{{{*/
    public function setTableName($hash = null)
    {/*{{{*/
        $this->tableName = 'demo';
    }/*}}}*/


    protected function getSelectFrontColumnComparisons()
    {/*{{{*/
        return array(
            'name' => '=',
        );
    }/*}}}*/
}/*}}}*/
