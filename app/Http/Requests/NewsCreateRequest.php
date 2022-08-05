<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class NewsCreateRequest extends FormRequest
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
            'title' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'max:255'],
            'content' => ['required'],
            "tags"    => ['array'],
            "tags.*"  => ['string','distinct','min:3','regex:/^[a-zA-Zа-ЯА-Я0-9]/i'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "Название новости" обязательно для заполнения',
            'title.min' => 'Поле "Название новости" должно содержать не менее 5 символов',
            'title.max' => 'Поле "Название новости" не должно превышать 20 символов',
            'description.required' => 'Поле "Краткое описание" обязательно для заполнения',
            'description.min' => 'Поле "Краткое описание" не должно превышать 255 символов',
            'content.required' => 'Поле "Содержание" обязательно для заполнения',
            'tags.*.distinct' => 'Поле "Название тега" не должно дублироваться',
            'tags.*.string' => 'Поле "Название тега" не должно быть пустым',
            'tags.*.min' => 'Поле "Название тега" не должно содержать менее 3 символов',
            'tags.*.regex' => 'Поле "Название тега" может содержать только цифры, латинские и русские буквы без пробелов',
        ];
    }
}
