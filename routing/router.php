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

        foreach ($this->redirectMap['get'] as $definedUrl => $definedController) {
            $regEx = str_replace(['{?}', '/'], ['([^.])', '\/'], $definedUrl);
            if (preg_match('/^'.$regEx.'$/', $url)) {
                call_user_func($definedController);
                break;
            }
        }
    }
}