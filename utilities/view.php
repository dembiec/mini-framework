<?php
namespace Utility;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    public $cache = true;

    public function twigCache(bool $cache = false)
    {
        $this->cache = $cache;
    }

    public function twigLoader()
    {
        $loader = new FilesystemLoader(dirname(__DIR__).'/views');
        if ($this->cache) {
            $twig = new Environment($loader, [
                'cache' => dirname(__DIR__).'/views/cache',
            ]);
        } else {
            $twig = new Environment($loader);
        }
        return $twig;
    }

    public function twigRender(string $file = null, array $varaiables = [])
    {
        echo $this->twigLoader()->render($file, $varaiables);
    }
}
