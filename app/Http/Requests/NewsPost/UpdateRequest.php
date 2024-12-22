<?php

namespace App\Http\Requests\NewsPost;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:250',
                Rule::unique('news_post')->ignore($this->route('news_post')->id),
            ],
            'content' => 'required|string',
            'for_followers' => 'nullable|string',
            'image' => 'nullable|image',
            'tags' => 'nullable|string',
            'remove_image' => 'required|string',
            'content_images' => 'nullable|string'
        ];
    }
}
