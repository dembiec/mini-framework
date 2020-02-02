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
            $regEx = str_replace(['{?}', '/'], ['([a-zA-Z0-9]+)', '\/'], $definedUrl);
            if (preg_match('/^'.$regEx.'$/', $url, $parameters)) {
                unset($parameters[0]);
                call_user_func($definedController, $parameters);
                exit;
            }
        }
        echo '404';
    }
}