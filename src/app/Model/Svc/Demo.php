<?php
/**
* @file Demo.php
* @author ligang
* @date 2015-08-24
 */

namespace Vdemo\Model\Svc;

class Demo extends SqlBase
{/*{{{*/
    public function insert($params = array())
    {/*{{{*/
        $item = $this->toEntityItemForInsert($params);

        try {
            $this->getSqlDao()->insert($item);
        } catch (\PDOException $e) {
            if (\Vine\Component\Mysql\Error::duplicateEntry($e)) {
                throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_DEMO_ITEM_EXISTS, 'Demo项已存在');
            }
            throw $e;
        }

        return $item;
    }/*}}}*/
    public function update($params = array())
    {/*{{{*/
        $id = $params['id'];

        $oldItem = $this->selectById($id);
        if (empty($oldItem)) {
            throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_DEMO_INVALID_ID, 'Id不正确');
        }

        $updateFields = $this->getUpdateFields($oldItem, $params);

        if (empty($updateFields)) {
            return 0;
        }

        try {
            return $this->getSqlDao()->updateById($id, $updateFields);
        } catch (\PDOException $e) {
            if (\Vine\Component\Mysql\Error::duplicateEntry($e)) {
                throw new \Vdemo\Lib\Error\Exception(\Vdemo\Lib\Error\Errno::E_DEMO_ITEM_EXISTS, 'Demo项已存在');
            }
            throw $e;
        }
    }/*}}}*/
}/*}}}*/
