<?php
class Home
{
    public static function show()
    {
        readfile(__DIR__ . "/../head.html");
        readfile(__DIR__ . "/home.html");
    }
}
