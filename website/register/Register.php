<?php
class Register
{
    public static function show()
    {
        readfile(__DIR__ . "/../head.html");
        readfile(__DIR__ . "/register.html");
    }
}
