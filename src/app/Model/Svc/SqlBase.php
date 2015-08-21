<?php
/**
* @file SqlBase.php
* @author ligang
* @date 2015-08-24
 */

namespace Vdemo\Model\Svc;

abstract class SqlBase
{/*{{{*/
    protected $container  = null;
    protected $entityName = '';

    public function __construct($entityName = '')
    {/*{{{*/
        $this->container = \Vdemo\AppContainer::getInstance();

        if ($entityName == '') {
            $clsName = get_class($this);
            $pos     = strrpos($clsName, '\\');

            $this->entityName = substr($clsName, $pos + 1);
        }
    }/*}}}*/

    /**
        * Select by id
        *
        * @param int $id
        *
        * @return array
     */
    public function selectById($id)
    {/*{{{*/
        return $this->getSqlDao()->selectById($id);
    }/*}}}*/

    /**
        * Select by ids
        *
        * @param array $ids
        * @param string $orderBy
        * @param int $bgn
        * @param int $cnt
        *
        * @return array
     */
    public function selectByIds($ids, $orderBy = 'id desc', $bgn = 0, $cnt = 0)
    {/*{{{*/
        if (empty($ids)) {
            return array();
        }

        return $this->getSqlDao()->selectByIds($ids, array(), $orderBy, $bgn, $cnt);
    }/*}}}*/

    /**
        * Select by params for front
        *
        * @param array $params
        * @param string $order_by
        * @param int $bgn
        * @param int $cnt
        *
        * @return array
     */
    public function selectByParamsForFront($params = array(), $orderBy = 'id desc', $bgn = 0, $cnt = 0)
    {/*{{{*/
        return $this->getSqlDao()->selectByParamsForFront($params, array(), $orderBy, $bgn, $cnt);
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
        return $this->getSqlDao()->selectTotalByParamsForFront($params);
    }/*}}}*/

    /**
        * delete by id
        *
        * @param int $id
        *
        * @return int
     */
    public function deleteById($id)
    {/*{{{*/
        return $this->getSqlDao()->deleteById($id);
    }/*}}}*/

    /**
        * Valid entity id
        *
        * @param int $id
        *
        * @return bool
     */
    public function validEntityId($id)
    {/*{{{*/
        $data = $this->getSqlDao()->selectById($id, array('id'));

        return empty($data) ? false : true;
    }/*}}}*/

    /**
        * Valid entity ids
        *
        * @param array $ids
        *
        * @return bool
     */
    public function validEntityIds($ids)
    {/*{{{*/
        $total = $this->getSqlDao()->selectTotalByIds($ids);

        return $total == count($ids) ? true : false;
    }/*}}}*/

    /**
        * @brief callback func args is optional
        * eg: doInSqlTrans($func, $a, $b, $c ...)
        *
        * @param $func
        *
        * @return 
     */
    public function doInSqlTrans($func)
    {/*{{{*/
        if (!is_callable($func)) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_SYS_FUNC_NOT_CALLABLE, 'func must be callable');
        }

        $dao  = $this->getSqlDao();
        $args = func_get_args();
        array_shift($args);

        try {
            $dao->beginTrans();
            call_user_func_array($func, $args);
            $dao->commit();
        } catch (\Exception $e) {
            $dao->rollback();
            throw $e;
        }
    }/*}}}*/

    /**
        * Get relation change data eg(user role): oneId is userId, newManyIds is newRoleIds
        *
        * @param $oneId
        * @param $newManyIds
        * @param $listRelationByOneIdFunc
        * @param $manyInRelationName
        *
        * @return 
     */
    public function getRelationChangeData($oneId, $newManyIds, $listRelationByOneIdFunc, $manyInRelationName)
    {/*{{{*/
        if (!is_callable($listRelationByOneIdFunc)) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_SYS_FUNC_NOT_CALLABLE, 'listRelationByOneIdFunc must be callable');
        }

        $result = array(
            'del_relation_ids'      => array(),
            'add_relation_many_ids' => array(),
        );

        $oldRelationIds = array();
        $oldMayIds      = array();
        foreach (call_user_func($listRelationByOneIdFunc, $oneId) as $item) {
            $oldRelationIds[$item[$manyInRelationName]] = $item['id'];
            $oldMayIds[] = $item[$manyInRelationName];
        }

        $delManyIds = array_diff($oldMayIds, $newManyIds);
        foreach ($delManyIds as $id)
        {
            $result['del_relation_ids'][] = $oldRelationIds[$id];
        }
        $result['add_relation_many_ids'] = array_diff($newManyIds, $oldMayIds);

        return $result;
    }/*}}}*/

    /**
        * Attach one to many field eg: one user attach many roles
        *
        * @param $fieldName
        * @param $oneData, objs or array
        * @param $getRelationFunc, args must be oneIds
        * @param $oneInRelationName
        * @param $manyInRelationName
        * @param $getManyFunc, args must be manyIds
        *
        * @return 
     */
    public function attachOneToManyField($fieldName, $oneData, $getRelationFunc, $oneInRelationName, $manyInRelationName, $getManyFunc)
    {/*{{{*/
        if (empty($oneData)) {
            return array();
        }

        if (!is_callable($getRelationFunc) || (!is_callable($getManyFunc))) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_SYS_FUNC_NOT_CALLABLE, 'getRelationFunc and getManyFunc must be callable');
        }

        $oneData      = $this->fmtSqlDataKeyUseId($oneData);
        $relationData = call_user_func($getRelationFunc, array_keys($oneData));
        $manyIds      = array();
        $oneIdManyIds = array();
        foreach ($relationData as $item) {
            $oneId  = $item[$oneInRelationName];
            $manyId = $item[$manyInRelationName];

            $oneIdManyIds[$oneId][] = $manyId;
            if (!isset($manyIds[$manyId])) {
                $manyIds[$manyId] = 1;
            }
        }

        $manyData = call_user_func($getManyFunc, array_keys($manyIds));
        $manyData = $this->fmtSqlDataKeyUseId($manyData);
        foreach ($oneData as $oneId => $one_item) {
            if (isset($oneIdManyIds[$oneId])) {
                foreach ($oneIdManyIds[$oneId] as $manyId) {
                    $oneData[$oneId][$fieldName][$manyId] = isset($manyData[$manyId]) ? $manyData[$manyId] : array();
                }
            } else {
                $oneData[$oneId][$fieldName] = array();
            }
        }

        return $oneData;
    }/*}}}*/

    /**
        * select by relation id eg: select userData by roleId
        *
        * @param $relationId
        * @param $getRelationFunc, args must be relationId
        * @param $manyInRelationName
        * @param $getManyFunc, args must by manyIds
        *
        * @return 
     */
    public function selectByRelationId($relationId, $getRelationFunc, $manyInRelationName, $getManyFunc)
    {/*{{{*/
        if (!is_callable($getRelationFunc) || !is_callable($getManyFunc)) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_SYS_FUNC_NOT_CALLABLE, 'getRelationFunc and getManyFunc must be callable');
        }

        $relationData = call_user_func($getRelationFunc, $relationId);

        $manyIds = array();
        foreach ($relationData as $item) {
            $manyIds[] = $item[$manyInRelationName];
        }

        return empty($manyIds) ? array() : call_user_func($getManyFunc, $manyIds);
    }/*}}}*/


    protected function getSqlDao()
    {/*{{{*/
        $clsName = '\Vdemo\Model\Dao\\'.$this->entityName;

        $dao = $this->container->get($clsName);
        if (is_null($dao)) {
            $dao = new $clsName();
            $dao->setDriver($this->container->getSqlDriver())
                ->setTableName();

            $this->container->add($clsName, $dao);
        }

        return $dao;
    }/*}}}*/
    protected function fmtSqlDataKeyUseId($data)
    {/*{{{*/
        $result = array();

        foreach ($data as $item) {
            $result[$item['id']] = $item;
        }

        return $result;
    }/*}}}*/
    protected function toEntityItemForInsert($item)
    {/*{{{*/
        $now = \Vine\Component\Tool\Toolbox::getNowDate();

        $item['id']        = $this->container->getIdGenter()->genId(lcfirst($this->entityName));
        $item['add_time']  = $now;
        $item['edit_time'] = $now;

        $clsName = '\Vdemo\Model\Entity\\'.$this->entityName;
        $entity  = new $clsName();
        $entity->setValidator(new \Vine\Component\Validator\Validator());
        $entity->setColumnsValues($item);

        return $entity->toItem();
    }/*}}}*/
    protected function getUpdateFields($oldItem, $params)
    {/*{{{*/
        $updateFields = array();
        foreach ($oldItem as $key => $value) {
            if (isset($params[$key])) {
                if ($params[$key] != $oldItem[$key]) {
                    $updateFields[$key] = $params[$key];
                }
            }
        }

        if (!empty($updateFields)) {
            if (!isset($updateFields['edit_time'])) {
                $updateFields['edit_time'] = \Vine\Component\Tool\Toolbox::getNowDate();
            }
        }

        return $updateFields;
    }/*}}}*/
}/*}}}*/
