<?php
class Approved {
    public static function show(){
        readfile(__DIR__."/approved.html");
    }
}