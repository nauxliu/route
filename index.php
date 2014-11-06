<?php
require __DIR__.'/vendor/autoload.php';

use CutePHP\Route\Router;

$router = new Router;
$router->get('/test/:id',function(){
    return 123;
});

$res = $router->match('/test/2','get');
$params = $res->getParams();
var_dump($params);