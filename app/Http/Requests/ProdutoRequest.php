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
            'category_id' => ['required', Rule::in(\App\Models\Category::categories()->pluck('id')->toArray())],
            'user_id' => ['required','integer'],
            'status' => ['nullable'],
            'valor_prod' => ['integer','required']
        ];    
        return $rules;
    }

    protected function prepareForValidation(){
        $this->merge([
            'user_id' => auth()->user()->id,
            // 'status' => 'em_analise',
        ]);
    }

    public function messages(){
        return[
            'nome_prod.required' => 'Nome é obrigatório',
            'valor_prod.required' => 'Valor é obrigatório',
            'category_id.required' => 'Categora é obrigatória',
        ];
    }

}
