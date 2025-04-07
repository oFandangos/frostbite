<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comentario;

class ComentarioController extends Controller
{
    public function store(Request $request){
        $comentario = new Comentario;

        $comentario->comentario = $request->comentario;
        $comentario->produto_id = $request->produto_id;
        $comentario->comentario_usuario_id = $request->auth()->user()->id;
        $comentario->save();

        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
