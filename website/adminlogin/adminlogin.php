<?php
class AdminLogin
{
    public static function show()
    {
        readfile(__DIR__ . "/../head.html");
        readfile(__DIR__ . "/adminlogin.html");
    }
}
