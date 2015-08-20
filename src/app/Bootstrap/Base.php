<?php
/**
* @file Base.php
* @author ligang
* @version 1.0
* @date 2015-08-19
 */

namespace Vdemo\Bootstrap;

/**
    * This is bootstrap base
 */
abstract class Base extends \Vine\Component\Bootstrap\Web
{/*{{{*/
    public function __construct($moduleName = '')
    {/*{{{*/
        if ($moduleName == '') {
            $moduleName = $this->genModuleName();
        }

        $rawSid   = $this->genRawSid();
        $logId    = base64_encode($rawSid);
        $formater = new \Vine\Component\Log\Formater\General($logId);

        \Vdemo\AppContainer::getInstance()
                           ->setModuleName($moduleName)
                           ->setRawSid($rawSid)
                           ->setLogId($logId)
                           ->setGeneralLogFormater($formater);
    }/*}}}*/

    protected function genModuleName()
    {/*{{{*/
        $clsName = get_class($this);
        $pos     = strrpos($clsName, '\\');

        return substr($clsName, $pos + 1);
    }/*}}}*/
    protected function genRawSid()
    {/*{{{*/
        list($usec, $sec) = explode(' ', microtime());

        $sidData[] = \Vine\Component\Tool\Toolbox::getIp();
        $sidData[] = \Vine\Component\Tool\Toolbox::getPort();
        $sidData[] = $sec;
        $sidData[] = number_format((float)$usec, 3) * 1000;
        $sidData[] = rand(0, 999);

        return implode(',', $sidData);
    }/*}}}*/
}/*}}}*/
