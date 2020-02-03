<?php
namespace Route;

class Router
{
    protected $redirectMap = [
        'get' => [],
        'post' => []
    ];

    public function get(string $url, string $controller)
    {
        $this->redirectMap['get'][$url] = $controller;
    }

    function __destruct()
    {
        $url = $_GET['url'];
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        foreach ($this->redirectMap[$requestMethod] as $definedUrl => $definedController) {
            $regEx = str_replace(['{?}', '/'], ['([a-zA-Z0-9]+)', '\/'], $definedUrl);
            if (preg_match('/^'.$regEx.'$/', $url, $parameters)) {            
                array_splice($parameters, 0,1);
                call_user_func($definedController, $parameters);
                exit;
            }
        }
        echo '404';
    }
}