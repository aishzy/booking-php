<?php

namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {
        return $this->view('home', [
            'title' => 'Welcome to Booking System',
            'message' => 'Book your perfect accommodation here'
        ]);
    }

    public function about() {
        return $this->view('about', [
            'title' => 'About Us'
        ]);
    }
}