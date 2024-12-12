<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockedController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.blocked');
    }
}
