<?php

class Token
{
    public static function generate($item)
    {
        return Session::put(Config::get('session/'.$item), md5(uniqid()));
    }

    public static function check($token, $token_name)
    {
        $tokenName = Config::get('session/'.$token_name);
        if(Session::exists($tokenName) && $token === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}
