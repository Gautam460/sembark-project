<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    public function authorize()
    {
        return in_array($this->user()->role, ['admin', 'member']);
    }

    public function rules()
    {
        return [
            'original_url' => 'required|url|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'original_url.required' => 'The original URL field is required.',
            'original_url.url' => 'Please provide a valid URL format (e.g., https://example.com).',
            'original_url.max' => 'The URL may not be greater than 2048 characters.',
        ];
    }
}
