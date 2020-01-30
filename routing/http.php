<?php
use Route\Router;
$router = new Router;

$router->get('/', 'App\Controllers::Main\Index');

$router->get('galeria', 'App\Controllers::Gallery\Show');

$router->get('kontakt', 'App\Controllers::Contact\Update');