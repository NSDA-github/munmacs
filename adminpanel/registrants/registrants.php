<?php
class Registrants {
    public static function show(){
        readfile(__DIR__."/registrants.html");
    }
}