<?php
namespace Utility;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Utility\Http;

class ViewExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('appUrl', function($url = NULL) {
                return Http::appUrl($url); 
            })
        ];
    }
}