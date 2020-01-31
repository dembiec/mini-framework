<?php
use Route\Router;
$router = new Router;

$router->get('foo', 'Controllers\Foo::bar');