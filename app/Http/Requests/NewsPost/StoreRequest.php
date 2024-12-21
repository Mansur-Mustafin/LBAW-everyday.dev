<?php

namespace App\Http\Requests\NewsPost;

use App\Models\NewsPost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        // dd($this);
        return [
            'title' => 'required|string|unique:news_post,title|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'content_images' => 'nullable|string'
        ];
    }
}
