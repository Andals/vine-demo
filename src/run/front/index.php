<?php
require(dirname(__DIR__).'/boot.php');

$webApp = new \Vine\Framework\App\Web('Vdemo');
$webApp->bootstrap(new \Vdemo\Bootstrap\Front())->run('Front');
