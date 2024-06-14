<?php

namespace App\Controllers;

class ErrorController extends Controller {

    public function run($args) {
        header("HTTP/1.0 404 Not Found");
        return $this->view('page/error');
    }
}
