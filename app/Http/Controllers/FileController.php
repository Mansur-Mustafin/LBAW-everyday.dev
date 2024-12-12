<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function ajaxUpload(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:' . implode(',', FileService::$systemTypes['post']),
            'model_id' => 'nullable|integer',
            'image_type' => 'nullable|string',
        ]);

        $model = null;

        if ($request->has('model_id')) {
            $model = NewsPost::find($validated['model_id']);
        }

        return FileService::upload($request, $model, $request->input('image_type'));
    }
}
