<?php

namespace App\Controllers;

use App\Core\View;

class HomeController {
    public function index($params) {
        View::render("home/index.html");        
    }
}