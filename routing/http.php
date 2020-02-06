<?php
use Route\Router;
$router = new Router;

$router->get('index', 'Controller\StaticPages::main');
$router->get('foo/{?}/bar', 'Controller\Foo::bar');