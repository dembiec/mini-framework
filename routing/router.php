<?php
namespace Route;
use Utility\Authorization;
use Utility\Config;

class Router
{
    protected $requestMethod = NULL;
      
    protected $redirectMap = [
        'get' => [],
        'post' => []
    ];

    function __construct()
    {
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if ($this->requestMethod === 'post') {
            if (!isset($_POST['_token']) || $_SESSION['csrf'] !== $_POST['_token']) {
                exit();
            }
        }
        $_SESSION['csrf'] = Authorization::csrfToken(32);
    }

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

        foreach ($this->redirectMap[$this->requestMethod] as $definedUrl => $definedController) {
            $regEx = str_replace(['{?}', '/'], ['([a-zA-Z0-9]+)', '\/'], $definedUrl);
            if (preg_match('/^'.$regEx.'$/', $url, $parameters)) {            
                $object = explode("::", $definedController);
                array_splice($parameters, 0,1);
                call_user_func([new $object[0], $object[1]], $parameters);
                exit();
            }
        }
        $config = Config::read('app');
        header('Location: '.$config['url'].'404');
    }
}