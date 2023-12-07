<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this['data'] = $this['datum'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:10',
            ],
            'article' => [
                'required',
                'alpha_num:ascii', // TODO check!
                Rule::unique('products')->ignore($this->product),
            ],
            'status' => [
                'required',
                Rule::in(['available', 'unavailable']),
            ],
            'data' => [
                'nullable',
                'array'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'article.alpha_num' => 'Значение поля "Артикул" может содержать только латинские символы и цифры.',
        ];
    }
}
