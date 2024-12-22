<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function contacts()
    {
        return view('pages.static.contacts');
    }

    public function about()
    {
        return view('pages.static.about');
    }

    public function features()
    {
        return view('pages.static.features');
    }
}
