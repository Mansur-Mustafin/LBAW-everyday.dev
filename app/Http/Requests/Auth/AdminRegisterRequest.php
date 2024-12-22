<?php

namespace App\Http\Requests\Auth;

class AdminRegisterRequest extends RegisterRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'reputation' => ['required', 'integer'],
            'is_admin' => ['required', 'string'],
            'password' => ['required', 'min:4'],
        ]);
    }
}
