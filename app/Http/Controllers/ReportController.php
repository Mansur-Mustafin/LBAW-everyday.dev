<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function show()
    {
        return view('pages.admin.admin', ['show' => 'reports']);
    }
}
