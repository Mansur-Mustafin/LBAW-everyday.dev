<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'public_name' => ['required', 'string', 'max:250'],
            'username' => [
                'required',
                'string',
                'max:40',
                Rule::unique('user')->ignore($this->route('user')->id),
                'regex:/^\S*$/',
            ],
            'email' => [
                'required',
                'email',
                'max:250',
                Rule::unique('user')->ignore($this->route('user')->id),
            ],
            'remove_image' => ['required', 'string'],
            'reputation' => 'nullable',
            'is_admin' => 'required|string',
            'new_password' => 'nullable|string|min:4',
            'adm_password' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'The email address is already registered.',
            'username.regex' => 'The username cannot contain spaces.'
        ];
    }
}
