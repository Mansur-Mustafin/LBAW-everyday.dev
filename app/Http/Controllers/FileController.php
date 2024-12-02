<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    static $default = 'default.jpg';
    static $diskName = 'public_uploads';

    static $systemTypes = [
        'profile' => ['png', 'jpg', 'jpeg', 'gif'],
        'post' => ['png', 'jpg', 'jpeg', 'gif'],
    ];

    public function ajaxUpload(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048|mimes:' . implode(',', self::$systemTypes['post']),
            'model_id' => 'required|integer',
            'image_type' => 'required|string',
        ]);

        $model = NewsPost::find($validated['model_id']);

        if (!$model) {
            return response()->json(['success' => false, 'message' => 'Model not found'], 404);
        }

        $this->upload($request, $model, $validated['image_type']);

        return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'path' => null]);
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

        $this->delete($model, $validated['image_type'], $validated['path']);

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }


    public static function upload(Request $request, User|NewsPost $model, string $imageType)
    {
        $type = $model instanceof User ? 'profile' : 'post';

        $request->validate([
            'image' => 'image|max:2048|mimes:' . implode(',', self::$systemTypes[$type]),
        ]);

        $file = $request->file('image');
        $fileName = $file->hashName();
        $filePath = $file->storeAs($type, $fileName, self::$diskName);

        Image::create([
            'path' => $filePath,
            'image_type' => $imageType,
            $model instanceof User ? 'user_id' : 'news_post_id' => $model->id,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'path' => $filePath]);
        }

        return redirect()->back();
    }

    public static function delete(User|NewsPost $model, string $imageType, string $path = null)
    {
        $image = null;
        switch ($imageType) {
            case Image::TYPE_PROFILE:
                $image = $model->profileImage;
                break;

            case Image::TYPE_POST_TITLE:
                $image = $model->titleImage;
                break;

            case Image::TYPE_POST_CONTENT:
                if($path) {
                    $image = $model->contentImages()->where('path', $path)->first();
                }
                break;
        }

        if ($image->path) {
            if (Storage::disk('public_uploads')->exists($image->path)) {
                Storage::disk('public_uploads')->delete($image->path);
            }
            $image->delete();
        }
    }
}
