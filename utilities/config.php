<?php
namespace Utility;

class Config
{
    public function read(string $file = null)
    {
        $path = dirname(__DIR__).'/config/'.$file.'.php';
        if (file_exists($path)) {
            return require_once($path);
        } else {
            return false;
        }
    } 
}