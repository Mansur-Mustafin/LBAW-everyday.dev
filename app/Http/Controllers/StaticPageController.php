<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
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
