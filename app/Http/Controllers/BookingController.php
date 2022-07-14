<?php

namespace App\Http\Controllers;

class BookingController extends Controller
{

    protected $viewPath = 'backend.bookings.';

    public function __construct()
    {

    }

    public function index()
    {

        return view($this->viewPath . 'index');
    }
}

