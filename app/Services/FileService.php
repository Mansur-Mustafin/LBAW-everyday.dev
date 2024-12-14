<?php

namespace App\Services;

use App\Enums\ImageTypeEnum;
use App\Models\Image;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($type === 'post') {
            $subDir1 = substr($fileName, 0, 2);
            $subDir2 = substr($fileName, 2, 2);
            $directory = "$type/$subDir1/$subDir2";
        } else {
            $directory = $type;
        }

        $filePath = $file->storeAs($directory, $fileName, self::$diskName);

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
