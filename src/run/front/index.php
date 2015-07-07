<?php
require(dirname(__DIR__).'/boot.php');

$webApp = new \Vine\App\Web('Vdemo');

try {
    $webApp->bootStrap(new \Vdemo\Bootstrap\Front())->run('Front');
} catch (\Exception $e) {
    var_dump($e->getCode(), $e->getMessage());
}
