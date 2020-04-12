<?php
class About
{
    public static function show()
    {
        readfile(__DIR__ . "/../head.html");
        readfile(__DIR__ . "/about.html");
    }
}
