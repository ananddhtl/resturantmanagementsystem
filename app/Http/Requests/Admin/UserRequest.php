<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user_id = $this->route('user');
        return [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'password' => $user_id ? 'nullable|string|min:8|max:30' : 'required|string|min:8|max:30',
            'address' => 'nullable|string|max:150',
            'phone' => 'nullable|string|min:8|max:15',
            'image' => 'nullable|string|exists:files,file_name',
            'role' => 'required|string|in:admin,chef,waiter,user'
        ];
    }
}
