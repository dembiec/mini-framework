<?php
use Route\Router;
$router = new Router;

$router->get('foo/{?}/bar', 'Controller\Foo::bar');