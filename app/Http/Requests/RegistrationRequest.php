<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required | unique:users',
            'district' => 'required',
            'password' => 'required | min:8',
            'password_confirm' => 'same:password'
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Необходимо заполнить поле',
            'email.required' => 'Укажите E-mail',
            'email.unique' => 'Этот E-mail уже занят',
            'district.required' => 'Укажите район проживания',
            'password.required' => 'Придумайте пароль для аккаунта',
            'password.min' => 'Пароль должен содержать минимум 8 символов',
            'password_confirm.same' => 'Пароли не совпадают'
        ];
    }
}
