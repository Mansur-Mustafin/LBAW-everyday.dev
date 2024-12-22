<?php

namespace App\Http\Requests\NewsPost;

use App\Models\NewsPost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    // TODO: add here ignore for same post. with Rule.
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
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'remove_image' => 'required|string',
            'content_images' => 'nullable|string'
        ];
    }
}
