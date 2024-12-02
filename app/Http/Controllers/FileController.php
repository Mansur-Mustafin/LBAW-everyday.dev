<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Models\NewsPost;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function ajaxUpload(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048|mimes:' . implode(',', FileService::$systemTypes['post']),
            'model_id' => 'required|integer',
            'image_type' => 'required|string',
        ]);

        $model = NewsPost::find($validated['model_id']);

        if (!$model) {
            return response()->json(['success' => false, 'message' => 'Model not found'], 404);
        }

        return FileService::upload($request, $model, $validated['image_type']);
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
