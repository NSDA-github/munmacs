<?php
class Home
{
    public static function show()
    {
        readfile(__DIR__ . "/../nav.html");
        readfile(__DIR__ . "/home.html");
    }
}
