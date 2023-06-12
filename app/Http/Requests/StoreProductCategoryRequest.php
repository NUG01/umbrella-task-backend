<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'კატეგორიის ველის შევსება აუცილებელია!',
            'category_name.string' => 'კატეგორიის ველი აუცილებელია რომ იყოს სიმბოლო!',
        ];
    }
}
