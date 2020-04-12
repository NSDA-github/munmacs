<?php
class Settings {
    public static function show(){
        readfile(__DIR__."/settings.html");
    }
}