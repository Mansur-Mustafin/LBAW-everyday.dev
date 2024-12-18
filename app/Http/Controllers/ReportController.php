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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'report_type' => 'required|string',
            'reporter_id' => 'required|integer|exists:user,id',
            'reported_user_id' => 'nullable|integer|exists:user,id',
            'news_post_id' => 'nullable|integer|exists:news_post,id',
            'comment_id' => 'nullable|integer|exists:comment,id',
        ]);

        $report = Report::create($validatedData);

        if ($request->report_type === 'PostReport' && $request->news_post_id) {
            return redirect()->route('news.show', $request->news_post_id)
                ->with('success', 'You have successfully reported the post!');
        }
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
