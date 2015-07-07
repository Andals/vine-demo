<?php
/**
* @file serverConf.php
* @brief array_replace_recursive($serverConf, $serverConf_rewrite)
* @author ligang
* @version 1.0
* @date 2015-04-07
 */

namespace Vdemo;

class ServerConf
{/*{{{*/
    private static $prjHome    = '';
    private static $serverConf = array();

    /**
        * @brief must called first
        *
        * @param $prjHome
        *
        * @return 
     */
    public static function init($prjHome)
    {/*{{{*/
        self::$prjHome = $prjHome;

        self::parseServerConf();

        if (self::isDev()) {
             error_reporting(E_ALL | E_STRICT);
        }
    }/*}}}*/

    public static function getPrjName()
    {/*{{{*/
        return self::$serverConf['prj_name'];
    }/*}}}*/
    public static function isDev()
    {/*{{{*/
        return self::$serverConf['is_dev'];
    }/*}}}*/
    public static function getLogRoot()
    {/*{{{*/
        return self::$prjHome.'/logs';
    }/*}}}*/
    public static function getTmpRoot()
    {/*{{{*/
        return self::$prjHome.'/tmp';
    }/*}}}*/
    public static function getSrcRoot()
    {/*{{{*/
        return self::$prjHome.'/src';
    }/*}}}*/
    public static function getViewRoot()
    {/*{{{*/
        return self::getSrcRoot().'/view';
    }/*}}}*/
    public static function getStaticServerType()
    {/*{{{*/
        return self::$serverConf['static_server'];
    }/*}}}*/
    public static function getFrontStaticRoot()
    {/*{{{*/
        return self::getSrcRoot().'/run/front';
    }/*}}}*/
    public static function getMysqlConf()
    {/*{{{*/
        return self::$serverConf['mysql'];
    }/*}}}*/


    private static function parseServerConf()
    {/*{{{*/
        $serverConf         = json_decode(file_get_contents(self::$prjHome.'/conf/server/server_conf.json'), true);
        $serverConf_rewrite = json_decode(file_get_contents(self::$prjHome.'/conf/server_conf_rewrite.json'), true);

        self::$serverConf = array_replace_recursive($serverConf, $serverConf_rewrite);
    }/*}}}*/
}/*}}}*/
