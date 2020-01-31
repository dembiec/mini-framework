<?php
use Route\Router;
$router = new Router;

$router->get('foo', 'Controller\Foo::bar');