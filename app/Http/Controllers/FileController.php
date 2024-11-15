<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NewsPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    static $default = 'default.jpg';
    static $diskName = 'public_uploads';

    static $systemTypes = [
        'profile' => ['png', 'jpg', 'jpeg', 'gif'],
        'post' => ['mp3', 'mp4', 'gif', 'png', 'jpg', 'jpeg'],
    ];

    private static function isValidType(String $type) {
        return array_key_exists($type, self::$systemTypes);
    }

    private static function defaultAsset(String $type) {
        return asset($type . '/' . self::$default);
    }

    private static function getFileName (String $type, int $id) {

        $fileName = null;
        switch($type) {
            case 'profile':
                $fileName = User::find($id)->profile_image;
                break;
            case 'post':
                // other models
                break;
        }

        return $fileName;
    }

    static function get(String $type, int $userId) {

        // Validation: upload type
        if (!self::isValidType($type)) {
            return self::defaultAsset($type);
        }

        // Validation: file exists
        $fileName = self::getFileName($type, $userId);
        if ($fileName) {
            return asset($type . '/' . $fileName);
        }

        // Not found: returns default asset
        return self::defaultAsset($type);
    }

   public static function upload(Request $request, User|NewsPost $model) {
        // Parameters
        $file = $request->file('title_photo');
        //$file = $request->file('file');
        $type = 'post';//$request->type;
        $id = $request->id;
        $extension = $file->getClientOriginalExtension();
        $imageType = "PostTitle";//$request->image_type;

        //dd($file);
        // Hashing
        $fileName = $file->hashName(); // generate a random unique id
//dd($type, $fileName, self::$diskName);
        // Save in correct folder and disk
        $file = $file->storeAs($type, $fileName, self::$diskName);

        Image::create([
            'path' => $file,
            'image_type' => $imageType,
            'news_post_id' => $model->id,
            //'user_id' => $model->id,
        ]);

        return redirect()->back();
    }

    public function index()
    {
        $user = Auth::user();
        return view('pages.upload', ['user' => $user]);
    }
}
