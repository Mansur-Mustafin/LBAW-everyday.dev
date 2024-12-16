<?php

namespace App\Http\Requests\NewsPost;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\NewsPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'content_images' => 'nullable|string'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (NewsPost::where('author_id', Auth::user()->id)
                    ->where('title', $this->input('title'))
                    ->where('content', $this->input('content'))
                    ->exists()) {
                    $validator->errors()->add('title', 'A post with the same title and content already exists.');
                }
            }
        ];
    }
}
