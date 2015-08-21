<?php
/**
* @file IdGenter.php
* @author ligang
* @version 
* @date 2015-08-24
 */

namespace Vdemo\Lib;

class IdGenter
{/*{{{*/
    private $driver = null;

    public function __construct(\Vine\Component\Mysql\Driver $driver)
    {/*{{{*/
        $this->driver = $driver;
    }/*}}}*/

	public function genId($key)
	{/*{{{*/
		$sql = 'update id_gen set max_id = last_insert_id(max_id + 1) ';
		$sql.= 'where keyword = ?';
        $this->driver->execute($sql, array($key));

		$sql  = 'select last_insert_id() as max_id';
		$rows = $this->driver->query($sql);
		
        return $rows[0]['max_id'];
	}/*}}}*/
}/*}}}*/
