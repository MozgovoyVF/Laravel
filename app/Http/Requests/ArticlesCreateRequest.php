<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class ArticlesCreateRequest extends FormRequest
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
            'code' => ['bail', 'required', ValidationRule::unique('articles'), 'max:20', 'regex:/^[0-9A-Za-z_-]+$/i'],
            'title' => ['required','min:5','max:100'],
            'description' => ['required','max:255'],
            'content' => ['required'],
            'published' => ['nullable'],
        ];
    }

    public function messages()
{
    return [
        'code.required' => 'Поле "Символьный код" обязательно для заполнения',
        'code.unique' => 'Поле "Символьный код" должно быть уникальным',
        'code.max' => 'Поле "Символьный код" не должно превышать 20 символов',
        'code.regex' => 'Поле "Символьный код" может содержать только цифры, латинские буквы и символы "-" и "_"',
        'title.required' => 'Поле "Title" обязательно для заполнения',
        'title.min' => 'Поле "Название статьи" должно содержать не менее 5 символов',
        'title.max' => 'Поле "Название статьи" не должно превышать 20 символов',
        'description.required' => 'Поле "Краткое описание" обязательно для заполнения',
        'description.min' => 'Поле "Краткое описание" не должно превышать 255 символов',
        'content.required' => 'Поле "Содержание" обязательно для заполнения',
    ];
}
}
