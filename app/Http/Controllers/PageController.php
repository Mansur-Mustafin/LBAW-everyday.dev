<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function contacts()
    {
        return view('pages.contacts');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function features()
    {
        return view('pages.features');
    }
}
