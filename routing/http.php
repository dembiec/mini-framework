<?php
use Route\Router;
$router = new Router;

<<<<<<< Updated upstream
=======
$router->get('index', 'Controller\StaticPages::main');

$router->get('login', 'Controller\Auth\Login::index');
$router->post('login', 'Controller\Auth\Login::login');
$router->get('logout', 'Controller\Auth\Login::logout');

>>>>>>> Stashed changes
$router->get('foo/{?}/bar', 'Controller\Foo::bar');