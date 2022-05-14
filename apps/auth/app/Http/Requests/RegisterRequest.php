<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:64'],
            "email" => ['required', 'string', 'email', 'unique:users,email'],
            "password" => ['required', 'string', 'confirmed', 'min:6'],
            "password_confirmation" => ['required', 'string', 'min:6'],
        ];
    }
}
