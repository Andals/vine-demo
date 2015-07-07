<?php
umask(0022);
$cur_path = dirname(__FILE__);

require_once("$cur_path/rigger.php");
require_once("$cur_path/conf.php");
require_once("$cur_path/tool.php");

$params = array();
$args   = array_slice($argv, 1);
foreach($args as $arg)
{
    $arg   = explode('=', $arg);
    $key   = trim($arg[0]);
    $value = trim($arg[1]);
    $params[$key] = $value;
}

$rigger = new Rigger();
try
{
    $rigger->run($params);
}
catch(Exception $e)
{
    echo $e->getMessage()."\n";
}
