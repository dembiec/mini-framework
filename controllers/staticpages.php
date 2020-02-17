<?php
namespace Controller;
use Utility\Authorization;
use Utility\view;

class StaticPages
{
    public function main()
    {
        $twig = new View();
        $twig->twigRender('main.html');
    }

    public function start()
    {
        Authorization::forLogged();
        $logPath = dirname(__DIR__).'/errors.log';
        if (file_exists($logPath)) {
            $logs = file_get_contents($logPath);
        } else {
            $log = NULL;
        }

        $twig = new View();
        $twig->twigRender('start.html', [
            'id' => $_SESSION['id'],
            'email' => $_SESSION['email'],
            'system' => php_uname('s'),
            'phpversion' => phpversion(),
            'logs' => $logs
        ]);
    }
}