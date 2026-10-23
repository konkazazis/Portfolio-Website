<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Old blog URLs lived on "/" — send them to the blog
        if (request()->hasAny(['category', 'search', 'page'])) {
            return redirect()->route('blog', request()->query(), 301);
        }

        return view('home');
    }
}
