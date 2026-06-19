<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteUserRequest extends FormRequest
{
    public function authorize()
    {
        return in_array($this->user()->role, ['superadmin', 'admin']);
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,member',
        ];

        if ($this->user()->role === 'superadmin') {
            $rules['company_name'] = 'required|string|max:255';
            $rules['role'] = 'required|in:admin'; // SuperAdmin creates the first Admin for a Client
        } else {
            $rules['role'] = 'required|in:admin,member';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The user name field is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use by another user.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'company_name.required' => 'The new company name is required.',
            'role.required' => 'Please select a role.',
            'role.in' => 'The selected role is invalid.',
        ];
    }
}
