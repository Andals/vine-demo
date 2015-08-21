<?php
$ENV = array
(/*{{{*/
    'dev' => array
    (/*{{{*/
        'IS_DEV'    => 'true',
        'USER'      => '${USER}',
        'PRJ_NAME'  => 'vdemo',
        'PRJ_HOME'  => '__ARG__(prj_home)',

        'RIGGER_TPL_ROOT' => '${PRJ_HOME}/rigger/client/tpl',

        'SERVER_CONF_TPL' => '${RIGGER_TPL_ROOT}/tpl_server_conf_rewrite.json',
        'SERVER_CONF_DST' => '${PRJ_HOME}/conf/server/${USER}_server_conf_rewrite.json',
        'SERVER_CONF_LN'  => '${PRJ_HOME}/conf/server_conf_rewrite.json',

        'ACCESS_LOG_BUFFER' => '1',
        'NGX_PORT'          => '80',

        'FRONT_DOMAIN'        => '${USER}.vdemo.com',
        'FRONT_ACCESS_LOG'    => '${FRONT_DOMAIN}.log',
        'FRONT_ERROR_LOG'     => '${FRONT_DOMAIN}.log.error',
        'FRONT_HTTP_CONF_TPL' => '${RIGGER_TPL_ROOT}/tpl_front_httpd.conf.ngx',
        'FRONT_HTTP_CONF_DST' => '${PRJ_HOME}/conf/http/${USER}_front_http.conf.ngx',
        'FRONT_HTTP_CONF_LN'  => '/usr/local/nginx/conf/include/${FRONT_DOMAIN}.conf',

        'GENERAL_NGX_LOG_ROOT' => '/usr/local/nginx/logs',

        'NGX_LOG_ROOT' => array(
            'ligang'    => '${GENERAL_NGX_LOG_ROOT}',
            'liangchao' => '${GENERAL_NGX_LOG_ROOT}',
            'default'   => '/data/nginx/logs/${FRONT_DOMAIN}/web',
        ),
    ),/*}}}*/
);/*}}}*/

$PRJ = array
(/*{{{*/
    'webserver' => 'nginx',
    'init_path' => array
    (/*{{{*/
        'tmp' => array(
            'path' => '${PRJ_HOME}/tmp',
            'mask' => '777',
            'sudo' => false
        ),
        'logs' => array(
            'path' => '${PRJ_HOME}/logs',
            'mask' => '777',
            'sudo' => false
        ),
    ),/*}}}*/
);/*}}}*/

$SYS = array
(/*{{{*/
    'conf' => array
    (/*{{{*/
        'server_conf' => array(
            'tpl'  => '${SERVER_CONF_TPL}',
            'dst'  => '${SERVER_CONF_DST}',
            'ln'   => '${SERVER_CONF_LN}',
            'sudo' => false,
        ),
        'front_http_conf' => array(
            'tpl'  => '${FRONT_HTTP_CONF_TPL}',
            'dst'  => '${FRONT_HTTP_CONF_DST}',
            'ln'   => '${FRONT_HTTP_CONF_LN}',
            'sudo' => true,
        ),
    ),/*}}}*/
);/*}}}*/
