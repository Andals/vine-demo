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
    const KEY_MODULE_NAME = 'moduleName';

    const KEY_RAW_SID = 'rawSid';
    const KEY_LOG_ID  = 'logId';

    const KEY_SQL_LOGGER           = 'sqlLogger';
    const KEY_GENERAL_LOG_FORMATER = 'generalLogFormater';

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
        return $this->get(self::KEY_RAW_SID);
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
        return $this->get(self::KEY_LOG_ID);
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
        return $this->get(self::KEY_GENERAL_LOG_FORMATER);
    }/*}}}*/
}/*}}}*/
