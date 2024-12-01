<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    static $default = 'default.jpg';
    static $diskName = 'public_uploads';

    static $systemTypes = [
        'profile' => ['png', 'jpg', 'jpeg', 'gif'],
        'post' => ['mp3', 'mp4', 'gif', 'png', 'jpg', 'jpeg'],
    ];

    public static function upload(Request $request, User|NewsPost $model, string $imageType)
    {
        // Parameters
        $type = $model instanceof User ? 'profile' : 'post';
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $fileName = $file->hashName();
        $filePath = $file->storeAs($type, $fileName, self::$diskName);

        Image::create([
            'path' => $filePath,
            'image_type' => $imageType,
            $model instanceof User ? 'user_id' : 'news_post_id' => $model->id,
        ]);

        return redirect()->back();
    }
}