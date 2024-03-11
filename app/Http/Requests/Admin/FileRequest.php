<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $file_id = $this->route('file');
        return [
            'title' => 'required|string|max:150',
            'image' => $file_id ? 'nullable|file|mimes:png,jpg,jpeg,gif|max:2048' : 'required|file|mimes:png,jpg,jpeg,gif|max:2048'
        ];
    }
}
