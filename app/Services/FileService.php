<?php

namespace App\Services;

use App\Models\Image;
use App\Models\User;
use App\Models\NewsPost;
use App\Enums\ImageTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileService
{
    static $default = 'default.jpg';
    static $diskName = 'public_uploads';

    static array $systemTypes = [
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


        return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'path' => $filePath]);
    }

    public static function delete(User|NewsPost $model, string $imageType, string $path = null)
    {
        $image = null;

        switch ($imageType) {
            case ImageTypeEnum::PROFILE:
                $image = $model->profileImage;
                break;

            case ImageTypeEnum::POST_TITLE:
                $image = $model->titleImage;
                break;

            case ImageTypeEnum::POST_CONTENT:
                if ($path) {
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

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}
