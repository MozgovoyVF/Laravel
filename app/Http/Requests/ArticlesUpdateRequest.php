<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule as ValidationRule;

class ArticlesUpdateRequest extends ArticlesCreateRequest
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

        return array_merge(parent::rules(), [
            'code' => [
                'bail',
                'required',
                'max:20',
                'regex:/^[0-9A-Za-z_-]+$/i',
                ValidationRule::unique('articles')->ignore($this->route('article.code'), 'code'),
            ],
        ]);
    }
}
