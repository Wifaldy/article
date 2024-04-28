<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseFormRequest;

class AddCategoryRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'articleCategoryIds' => ['array', 'min:1'],
            'articleCategoryIds.*' => ['exists:article_categories,id'],
        ];
    }
}
