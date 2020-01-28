<?php

require "../Server.php";

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function () {
    Home::show();
});

$klein->respond('GET', '/register', function () {
    Register::show();
});

$klein->respond('GET', '/about', function () {
    Countries::show();
    Countries::getCountries();
});

$klein->dispatch();
