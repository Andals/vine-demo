<?php
/**
* @file Errno.php
* @brief errno
* @author ligang
* @version 1.0
* @date 2015-04-08
 */

namespace Vdemo\Lib\Error;

class Errno
{/*{{{*/
    const SUCCESS = 0;

    const E_SYS_CLS_NOT_EXISTS      = 11;
    const E_SYS_INVALID_DEBUG_PARAM = 12;
    const E_SYS_FUNC_NOT_CALLABLE   = 13;

    const E_COMMON_USER_NO_PERMISSION = 101;
    const E_COMMON_INVALID_PAGENO     = 102;
    const E_COMMON_INVALID_LOGOUT_URL = 103;

    const E_RELATION_ROLE_ROLE_SET_RELATION_EXISTS   = 201;
    const E_RELATION_ROLE_USER_RELATION_EXISTS       = 202;
    const E_RELATION_RESOURCE_ACTION_RELATION_EXISTS = 203;

    const E_API_INVALID_PARAM_TIME  = 301;
    const E_API_INVALID_PARAM_NONCE = 302;
    const E_API_INVALID_PARAM_SIGN  = 303;
    const E_API_INVALID_PARAM_VER   = 304;

    const E_PERMISSION_INVALIDE_AUTH_DATA = 301;
    const E_PERMISSION_PERMISSION_EXISTS  = 302;
    const E_PERMISSION_INVALID_AUTH       = 303;

    const E_APP_INVALID_ID          = 1001;
    const E_APP_INVALID_NAME        = 1002;
    const E_APP_INVALID_DESCRIPTION = 1003;
    const E_APP_INVALID_TOKEN       = 1004;
    const E_APP_APP_EXISTS          = 1005;

    const E_ROLE_INVALID_ID     = 1101;
    const E_ROLE_INVALID_NAME   = 1102;
    const E_ROLE_ROLE_EXISTS    = 1103;
    const E_ROLE_INVALID_IDS    = 1104;
    const E_ROLE_INVALID_APP_ID = 1105;

    const E_USER_INVALID_ID    = 1201;
    const E_USER_INVALID_NAME  = 1202;
    const E_USER_INVALID_EMAIL = 1203;
    const E_USER_INVALID_PHONE = 1204;
    const E_USER_USER_EXISTS   = 1205;

    const E_RESOURCE_INVALID_ID          = 1301;
    const E_RESOURCE_INVALID_KEYWORD     = 1302;
    const E_RESOURCE_INVALID_NAME        = 1303;
    const E_RESOURCE_INVALID_APP_ID      = 1304;
    const E_RESOURCE_RESOURCE_EXISTS     = 1305;
    const E_RESOURCE_INVALID_IDS         = 1306;

    const E_ACTION_INVALID_ID          = 1401;
    const E_ACTION_INVALID_NAME        = 1402;
    const E_ACTION_INVALID_KEYWORD     = 1403;
    const E_ACTION_INVALID_APP_ID      = 1404;
    const E_ACTION_ACTION_EXISTS       = 1405;
    const E_ACTION_INVALID_IDS         = 1406;
}/*}}}*/
