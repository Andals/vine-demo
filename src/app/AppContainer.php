<?php
/**
* @file Loader.php
* @author ligang
* @version 1.0
* @date 2015-08-19
 */

namespace Vdemo;

/**
    * This is app global container
 */
class AppContainer extends \Vine\Component\Container\General
{/*{{{*/
    const KEY_MODULE_NAME = 'module_name';

    const KEY_RAW_SID = 'raw_sid';
    const KEY_LOG_ID  = 'log_id';

    const KEY_GENERAL_LOG_FORMATER = 'general_log_formater';
    const KEY_SQL_LOGGER           = 'sql_logger';
    const KEY_SQL_DRIVER           = 'sql_driver';
    const KEY_ID_GENTER            = 'id_genter';

    private static $instance = null;

    private function __construct()
    {/*{{{*/
    }/*}}}*/

    /**
        * Singleton
        *
        * @return self
     */
    public static function getInstance()
    {/*{{{*/
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }/*}}}*/

    /**
        * Set moduleName
        *
        * @param string $moduleName
        *
        * @return self
     */
    public function setModuleName($moduleName)
    {/*{{{*/
        return $this->add(self::KEY_MODULE_NAME, $moduleName);
    }/*}}}*/

    /**
        * Get moduleName
        *
        * @return string
     */
    public function getModuleName()
    {/*{{{*/
        return $this->get(self::KEY_MODULE_NAME);
    }/*}}}*/

    /**
        * Set raw sid
        *
        * @param string $rawSid
        *
        * @return self
     */
    public function setRawSid($rawSid)
    {/*{{{*/
        return $this->add(self::KEY_RAW_SID, $rawSid);
    }/*}}}*/

    /**
        * Get raw sid
        *
        * @return string
     */
    public function getRawSid()
    {/*{{{*/
        $rawSid = $this->get(self::KEY_RAW_SID);
        if ('' == $rawSid) {
            list($usec, $sec) = explode(' ', microtime());

            $sidData[] = \Vine\Component\Tool\Toolbox::getIp();
            $sidData[] = \Vine\Component\Tool\Toolbox::getPort();
            $sidData[] = $sec;
            $sidData[] = number_format((float)$usec, 3) * 1000;
            $sidData[] = rand(0, 999);

            $rawSid = implode(',', $sidData);
            $this->setRawSid($rawSid);
        }

        return $rawSid;
    }/*}}}*/

    /**
        * Set logId
        *
        * @param string $logId
        *
        * @return self
     */
    public function setLogId($logId)
    {/*{{{*/
        return $this->add(self::KEY_LOG_ID, $logId);
    }/*}}}*/

    /**
        * Get logId
        *
        * @return string
     */
    public function getLogId()
    {/*{{{*/
        $logId = $this->get(self::KEY_LOG_ID);
        if ('' == $logId) {
            $logId = base64_encode($this->getRawSid());
            $this->setLogId($logId);
        }

        return $logId;
    }/*}}}*/

    /**
        * Set general log formater
        *
        * @param \Vine\Component\Log\Formater $formater
        *
        * @return self
     */
    public function setGeneralLogFormater(\Vine\Component\Log\Formater\FormaterInterface $formater)
    {/*{{{*/
        return $this->add(self::KEY_GENERAL_LOG_FORMATER, $formater);
    }/*}}}*/

    /**
        * Get general log formater
        *
        * @return \Vine\Component\Log\Formater or null
     */
    public function getGeneralLogFormater()
    {/*{{{*/
        $formater = $this->get(self::KEY_GENERAL_LOG_FORMATER);
        if (is_null($formater)) {
            $formater = new \Vine\Component\Log\Formater\General($this->getLogId());
            $this->setGeneralLogFormater($formater);
        }

        return $formater;
    }/*}}}*/

    /**
        * Set sql logger
        *
        * @param \Vine\Component\Log\Logger $logger
        *
        * @return self
     */
    public function setSqlLogger(\Vine\Component\Log\Logger $logger)
    {/*{{{*/
        return $this->add(self::KEY_SQL_LOGGER, $logger);
    }/*}}}*/

    /**
        * Get sql logger
        *
        * @return \Vine\Component\Log\Logger
     */
    public function getSqlLogger()
    {/*{{{*/
        $logger = $this->get(self::KEY_SQL_LOGGER);
        if (is_null($logger)) {
            $formater   = $this->getGeneralLogFormater();
            $moduleName = $this->getModuleName();
            $writer     = new \Vine\Component\Log\Writer\File(\Vdemo\ServerConf::getLogRoot().'/'.lcfirst($moduleName).'_mysql.log');
            $logger     = new \Vine\Component\Log\Logger($formater, $writer);

            $this->setSqlLogger($logger);
        }

        return $logger;
    }/*}}}*/

    /**
        * Get mysql driver
        *
        * @return 
     */
    public function getSqlDriver()
    {/*{{{*/
        $driver = $this->get(self::KEY_SQL_DRIVER);
        if (is_null($driver)) {
            $logger = $this->getSqlLogger();
            $dbConf = \Vdemo\ServerConf::getMysqlConf();
            $driver = new \Vine\Component\Mysql\Driver($dbConf, $logger);

            $this->add(self::KEY_SQL_DRIVER, $driver);
        }

        return $driver;
    }/*}}}*/

    /**
        * Get IdGenter
        *
        * @return 
     */
    public function getIdGenter()
    {/*{{{*/
        $idGenter = $this->get(self::KEY_ID_GENTER);
        if (is_null($idGenter)) {
            $idGenter = new \Vdemo\Lib\IdGenter($this->getSqlDriver());

            $this->add(self::KEY_ID_GENTER, $idGenter);
        }

        return $idGenter;
    }/*}}}*/

    /**
        * Get svc which extends sqlBase
        *
        * @param $svcName
        * @param $entityName
        *
        * @return 
     */
    public function getSqlSvc($svcName, $entityName = '')
    {/*{{{*/
        $clsName = '\Vdemo\Model\Svc\\'.str_replace('/', '\\', $svcName);

        $svc = $this->get($clsName);
        if (is_null($svc)) {
            $svc = new $clsName($entityName);
            $this->add($clsName, $svc);
        }

        return $svc;
    }/*}}}*/
}/*}}}*/
