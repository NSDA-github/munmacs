<?php
class Register
{
    public static function show()
    {
        readfile(__DIR__ . "/../nav.html");
        readfile(__DIR__ . "/register.html");
    }
}
