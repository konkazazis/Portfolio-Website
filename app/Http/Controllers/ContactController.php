<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        $bookingUrl = config('services.booking.url');

        return view('contact', compact('bookingUrl'));
    }
}
