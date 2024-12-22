<?php

namespace App\Http\Requests\NewsPost;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        // dd($this);
        return [
            'title' => 'required|string|unique:news_post,title|max:250',
            'content' => 'required|string',
            'for_followers' => 'required|string',
            'image' => 'nullable|image',
            'tags' => 'nullable|string',
            'content_images' => 'nullable|string'
        ];
    }
}
