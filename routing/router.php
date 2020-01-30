<?php
namespace Route;

class Router
{
    protected $redirectMap = [
        'get' => [],
        'post' => []
    ];

    public function get($url, $tmp)
    {
        $this->redirectMap['get'][$url] = $tmp;
    }

    function __destruct()
    {
        if (isset($this->redirectMap['get'][$_GET['url']])) {
            echo true;
        } else {
            echo false;
        }
    }
}