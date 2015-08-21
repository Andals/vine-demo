<?php
/**
* @file Base.php
* @author ligang
* @date 2015-08-24
 */

namespace Vdemo\Model\Dao;

/**
    * Base dao
 */
abstract class Base extends \Vine\Component\Mysql\Dao\Base
{/*{{{*/
    abstract protected function getSelectFrontColumnComparisons();


    /**
        * Select by params for front
        *
        * @param array $params
        * @param array $columnNames
        * @param string $orderBy
        * @param int $bgn
        * @param int $cnt
        *
        * @return array
     */
    public function selectByParamsForFront($params = array(), $columnNames = array(), $orderBy = '', $bgn = 0, $cnt = 0)
    {/*{{{*/
        $this->simpleSqlBuilder
             ->select($this->getSimpleWhat($columnNames), $this->tableName)
             ->where($this->getSelectFrontColumnComparisons(), $params)
             ->orderBy($orderBy)
             ->limit($bgn, $cnt);

        return $this->simpleQuery();
    }/*}}}*/

    /**
        * Select total by params for front
        *
        * @param array $params
        *
        * @return int
     */
    public function selectTotalByParamsForFront($params = array())
    {/*{{{*/
        $this->simpleSqlBuilder
             ->select('count(*) as cnt', $this->tableName)
             ->where($this->getSelectFrontColumnComparisons(), $params);

        $data = $this->simpleQuery();

        return intval($data[0]['cnt']);
    }/*}}}*/
}/*}}}*/
