<?php
namespace Utility;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    public $cache = TRUE;
    public $clearCache = FALSE;

    public function twigCache(bool $cache = FALSE)
    {
        $this->cache = $cache;
    }

    public function twigClearCache(bool $clearCache = TRUE)
    {
        $this->clearCache = $clearCache;
    }

    public function twigLoader()
    {
        $loader = new FilesystemLoader(dirname(__DIR__).'/views');
        if ($this->cache) {
            $twig = new Environment($loader, [
                'cache' => dirname(__DIR__).'/views/cache',
                'auto_reload' => $this->clearCache
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
