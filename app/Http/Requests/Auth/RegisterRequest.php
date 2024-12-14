<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'public_name' => ['required', 'string', 'max:250'],
            'username' => ['required', 'string', 'max:40', 'unique:user'],
            'email' => ['required', 'email', 'max:250', 'unique:user'],
            'password' => ['required', 'min:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'The email address is already registered.'
        ];
    }

    // TODO: Nem sei se isso funciona
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        $validated['password'] = Hash::make($this->input('password'));

        return $validated;
    }
}
