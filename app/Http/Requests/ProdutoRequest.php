<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdutoRequest extends FormRequest
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
        $rules = [
            'nome_prod' => 'required',
            // 'category_id' => ['', Rule::in(\App\Models\Category::categories())],
            'valor_prod' => 'int'
        ];
        return $rules;
    }

    public function messages(){
        return[
            'valor_prod.integer' => 'valor inteiro'
        ];
    }

}
