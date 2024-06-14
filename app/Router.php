<?php

namespace App;

class Router
{

    private $controller;

    public function __construct($request)
    {
        $url = $this->parseURL($request);

        if (empty($url[0])) {
            //$this->redirect('home');
            $url[0] = 'home';
        }

        $controllerClass = $this->camelize(array_shift($url)) . 'Controller';

        if (!file_exists('app/controllers/' . $controllerClass . '.php')) {
            //$this->redirect('error');
            $controllerClass = 'ErrorController';
        }

        $controllerClass = '\App\Controllers\\' . $controllerClass;

        $this->controller = new $controllerClass;

        echo $this->controller->run($url);
    }

    public function run()
    {

    }

    private function camelize($str)
    {
        $temp = str_replace('-', ' ', $str);
        $temp = ucwords($temp);
        $temp = str_replace(' ', '', $temp);
        return $temp;
    }

    private function parseURL($url)
    {
        $parsed = $url;
        $parsed = ltrim($parsed, "/");
        $parsed = trim($parsed);
        $path = explode("/", $parsed);
        return $path;
    }

}