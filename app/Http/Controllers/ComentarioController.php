<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Produto;

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

    public function destroy(Request $request, Comentario $comentario){
        $comentario->delete();
        request()->session()->flash('alert-success','Comentário excluído.');
        return redirect()->back();
    }

}
