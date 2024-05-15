<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required | max:255',
            'text' => 'required',
            'img' => 'required | mimes:jpeg,png,jpg'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Укажите заголовок',
            'title.max' => 'Слишком длинный заголовок',
            'text.required' => 'Напишите текст',
            'img.required' => 'Добавьте хотя бы 1 изображение',
            'img.mimes' => 'Некорректный формат изображения'
        ];
    }
}
