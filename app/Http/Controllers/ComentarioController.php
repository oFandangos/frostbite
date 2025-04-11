<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Produto;
use App\Http\Requests\ComentarioRequest;

class ComentarioController extends Controller
{
    public function store(Request $request, Produto $produto){
        $comentario = new Comentario;
        $comentario->comentario = $request->comentario;
        $comentario->produto_id = $produto->id;
        $comentario->comentario_usuario_id = auth()->user()->id;
        $comentario->created_at = now();
        $comentario->save();

        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }

    public function update(ComentarioRequest $request, Comentario $comentario){
        $comentario = Comentario::where('id',$request->submit)
        ->where('comentario_usuario_id',auth()->user()->id)
        ->first();
        
        $validated = $request->validated();
        if($validated && $comentario){
            $comentario->update($validated);
            return redirect()->back()->with('alert-success','Mensagem alterada com sucesso');
        }
        abort(403);
    }

    public function destroy(Request $request, Comentario $comentario){
        if($comentario->comentario_usuario_id == auth()->user()->id){
            $comentario->delete();
            request()->session()->flash('alert-success','Comentário excluído.');
            return redirect()->back();
        }
        abort(403);
    }

}
