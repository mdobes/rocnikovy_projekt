<?php

require __DIR__ . "/vendor/autoload.php";

mb_internal_encoding("UTF-8");

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new \App\Router(explode('?', $_SERVER['REQUEST_URI'], 2)[0]);
$router->run();
