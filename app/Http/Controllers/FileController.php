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

        return FileService::upload($request, $model, $request->has('image_type') ?? $validated['image_type']);
    }

    public function ajaxDelete(Request $request)
    {
        $validated = $request->validate([
            'model_id' => 'required|integer',
            'image_type' => 'required|string',
            'path' => 'required|string' //TODO: passa aqui o path de imagem que temos que deletar.
        ]);

        $model = NewsPost::find($validated['model_id']);

        if (!$model) {
            return response()->json(['success' => false, 'message' => 'Model not found'], 404);
        }

        return FileService::delete($model, $validated['image_type'], $validated['path']);
    }
}
