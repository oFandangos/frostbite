<?php

namespace App\Http\Requests;

use App\Models\Produto;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class ComentarioRequest extends FormRequest
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
        return [
            'comentario' => 'required|max:255',
            'produto_id' => ['required', 'exists:produtos,id'],
            'comentario_usuario_id' => ['required','integer'],
            'created_at' => 'required'
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'comentario_usuario_id' => Auth::user()->id,
            'produto_id' =>
            $this->route('comentario') ? 
            $this->route('produto')->id : //pega o id do prod. se for edição
            $this->route('produto'), //se for create de um novo comentário
            'created_at' => now(),
        ]);
    }

    public function messages(){
        return [
            'comentario.required' => 'O comentário é obrigatório',
            'comentario.max' => 'Limites de carecteres atingido',
        ];
    }

}
