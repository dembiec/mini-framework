<?php
namespace Route;

class Router
{
    protected $redirectMap = [
        'get' => [],
        'post' => []
    ];

    public function get(string $url = NULL, string $controller = NULL)
    {
        $this->redirectMap['get'][$url] = $controller;
    }

    public function post(string $url = NULL, string $controller = NULL)
    {
        $this->redirectMap['post'][$url] = $controller;
    }

    function __destruct()
    {
        $url = $_GET['url'];
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        foreach ($this->redirectMap[$requestMethod] as $definedUrl => $definedController) {
            $regEx = str_replace(['{?}', '/'], ['([a-zA-Z0-9]+)', '\/'], $definedUrl);
            if (preg_match('/^'.$regEx.'$/', $url, $parameters)) {            
                $object = explode("::", $definedController);
                array_splice($parameters, 0,1);
                call_user_func([new $object[0], $object[1]], $parameters);
                exit;
            }
        }
        echo '404';
    }
}