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

    const E_SYS_CLS_NOT_EXISTS    = 11;
    const E_SYS_FUNC_NOT_CALLABLE = 12;

    const E_COMMON_USER_NO_PERMISSION = 101;
    const E_COMMON_INVALID_PAGENO     = 102;
    const E_COMMON_INVALID_ADD_TIME   = 103;
    const E_COMMON_INVALID_EDIT_TIME  = 104;

    const E_DEMO_INVALID_NAME = 1001;
    const E_DEMO_ITEM_EXISTS  = 1002;
    const E_DEMO_INVALID_ID   = 1003;
}/*}}}*/
