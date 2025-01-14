<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id() . '|max:255',
            'profile_pic' => 'nullable|image|max:2048',
            'hobbies' => 'nullable|string',
            'address' => 'nullable|string',
            'phoneNumber' => 'nullable|string',
            'dob' => 'nullable|date',
            'job' => 'nullable|string',
            'relationship' => 'nullable|string',
            'language' => 'nullable|in:en,vn',
            'dark_mode' => 'nullable|in:light,dark',
        ];
    }
}
