<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {   
        // Xác định người dùng có quyền thực hiện yêu cầu này hay không.
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
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
