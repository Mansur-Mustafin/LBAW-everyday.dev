<?php

namespace App\Http\Requests\NewsPost;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'for_followers' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'remove_image' => 'required|string',
            'content_images' => 'nullable|string'
        ];
    }
}
