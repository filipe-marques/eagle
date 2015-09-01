<?php

class Config
{
    public static function get($path = null)
    {
        if($path)
        {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            foreach($path as $b)
            {
                if(isset($config[$b]))
                    $config = $config[$b];
            }
            return $config;
        }
        return false;
    }
}
