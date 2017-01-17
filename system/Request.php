<?php

namespace sys;

class Request
{
    public static function method(){

        return $_SERVER['REQUEST_METHOD'];
    }

    public static function URI(){

        return parse_url(trim($_SERVER['REQUEST_URI'], "/"), PHP_URL_PATH);
    }
}