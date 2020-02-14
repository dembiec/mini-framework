<?php
namespace Utility;

class Config
{
    public function read(string $file = null)
    {
        $path = dirname(__DIR__).'/config/'.$file.'.php';
        if (file_exists($path)) {
            return require($path);
        } else {
            return false;
        }
    } 
}