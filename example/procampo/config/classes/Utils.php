<?php

class Utils
{
    public static function showErrors()
    {
        // DEVELOPMENT PURPOSES - DO NOT USE THIS IN PRODUCTION ENVIRONMENT
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('html_errors', false);
    }

    public static function me()
    {
        echo($_SERVER['PHP_SELF']);
    }
}
