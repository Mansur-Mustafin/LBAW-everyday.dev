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

    public function destroy(Report $report)
    {
        try {
            $report->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
