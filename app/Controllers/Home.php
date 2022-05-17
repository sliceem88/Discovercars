<?php

namespace App\Controllers;

use App\Core\View;

class Home
{
    public function index()
    {
        View::render('homepage');
    }
}
