<?php
namespace Utility;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Utility\Http;
use Utility\Authorization;

class ViewExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('appUrl', function(string $url = NULL) {
                return Http::appUrl($url); 
            }),
            new TwigFunction('isLogged', function() {
                return Authorization::isLogged(); 
            })
        ];
    }
}