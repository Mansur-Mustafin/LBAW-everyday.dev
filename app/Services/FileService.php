<?php

namespace App\Services;

use App\Models\Image;
use App\Models\User;
use App\Models\NewsPost;
use App\Enums\ImageTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileService
{
    static $diskName = 'public_uploads';

    static array $systemTypes = [
        'profile' => ['png', 'jpg', 'jpeg', 'gif'],
        'post' => ['png', 'jpg', 'jpeg', 'gif'],
    ];

    public static function upload(Request $request, User|NewsPost|null $model, ?string $imageType)
    {
        $type = $model instanceof User ? 'profile' : 'post';

        $request->validate([
            'image' => 'image|mimes:' . implode(',', self::$systemTypes[$type]),
        ]);

        $file = $request->file('image');
        $fileName = $file->hashName();
        $filePath = $file->storeAs($type, $fileName, self::$diskName);

        if ($model) {
            Image::create([
                'path' => $filePath,
                'image_type' => $imageType,
                $model instanceof User ? 'user_id' : 'news_post_id' => $model->id,
            ]);
        }


        return response()->json(['success' => true, 'message' => 'Image uploaded successfully', 'path' => asset($filePath)]);
    }

    public static function delete(User|NewsPost $model, string $imageType, array $paths = null)
    {



        switch ($imageType) {
            case ImageTypeEnum::PROFILE->value:
                $image = $model->profileImage;
                if ($image->path) {
                    if (Storage::disk('public_uploads')->exists($image->path)) {
                        Storage::disk('public_uploads')->delete($image->path);
                    }

                    $image->delete();
                }
                break;

            case ImageTypeEnum::POST_TITLE->value:
                $image = $model->titleImage;
                if ($image->path) {
                    if (Storage::disk('public_uploads')->exists($image->path)) {
                        Storage::disk('public_uploads')->delete($image->path);
                    }

                    $image->delete();
                }
                break;

            case ImageTypeEnum::POST_CONTENT->value:
                $query = $model->contentImages();

                if (!empty($paths)) {
                    $query->whereNotIn('path', $paths);
                }

                $imagePaths = $query->pluck('path')->toArray();

                if (!empty($imagePaths)) {
                    Storage::disk('public_uploads')->delete($imagePaths);

                    $query->delete();
                }
                break;
        }

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}
