<?php
namespace Utility;
use Utility\Config;

class Http
{
    public function urlParam($paramIndex = null)
    {
        $url = $_GET['url'];
        
        $parameter = explode('/', $url);
        $parameter = array_filter($parameter);

        if (!empty($paramIndex) || $paramIndex == 0) {
            if (is_array($paramIndex)) {
                $newParam = [];
                foreach ($parameter as $parameterKey => $parameterValue) {
                    foreach ($paramIndex as $paramIndexKey => $paramIndexValue) {
                        if ($parameterKey == $paramIndexValue) {
                            $newParam[] = $parameterValue;
                        }
                    }
                }
                return $newParam;
            } else {
                return $parameter[$paramIndex];
            }
        } else {
            return $parameter;
        }
    }

    public function appUrl(string $getParameter = NULL)
    {
        $appUrl = Config::read('app');
        return $appUrl['url'].$getParameter;
    }
}