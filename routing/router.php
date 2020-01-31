<?php
namespace Route;

class Router
{
    protected $redirectMap = [
        'get' => [],
        'post' => []
    ];

    public function get($url, $controller)
    {
        $this->redirectMap['get'][$url] = $controller;
    }

    function __destruct()
    {
        $url = $_GET['url'];
        if (isset($this->redirectMap['get'][$url])) {
            call_user_func($this->redirectMap['get'][$url]);
        } else {
            echo 0;
        }
    }
}