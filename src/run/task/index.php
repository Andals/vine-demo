#!/usr/local/php/bin/php
<?php
require(dirname(__DIR__).'/boot.php');

$taskApp = new \Vine\Framework\App\Task('Vdemo');
$taskApp->bootstrap(new \Vdemo\Bootstrap\Task())->run('Task');
