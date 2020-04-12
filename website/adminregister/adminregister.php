<?php
class AdminRegister
{
    public static function show()
    {
        readfile(__DIR__ . "/../head.html");
        readfile(__DIR__ . "/adminregister.html");
    }
}