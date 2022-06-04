<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
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
            "email" => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->route('user')->id)],
            "email_verified_at" => ['nullable', 'date'],
            "role_id" => ['required', 'integer', 'exists:roles,id'],
            "password" => ['nullable', 'string', 'confirmed', 'min:6'],
        ];
    }
}
