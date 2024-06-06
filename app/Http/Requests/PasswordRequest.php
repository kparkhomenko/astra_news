<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'password' => 'required',
            'new_password' => 'required | min:8 |'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Укажите старый пароль',
            'new_password.required' => 'Укажите новый пароль',
            'new_password.min' => 'Пароль должен содержать минимум 8 символов'
        ];
    }
}
