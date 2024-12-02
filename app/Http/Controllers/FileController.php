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

        return redirect()->back();
    }

    public static function delete(User|NewsPost $model, string $imageType)
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
                // TODO
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
