<?php
class SysAdminPanel {
    public static function show(){
        readfile(__DIR__."/sysadminpanel.html");
    }
}