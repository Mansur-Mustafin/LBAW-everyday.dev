<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPost;

class NewsController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::orderBy('created_at', 'desc')->get();

        return view('home', compact('newsPosts'));
    }
}
