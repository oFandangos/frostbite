<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Produto;
use App\Http\Requests\ComentarioRequest;

class ComentarioController extends Controller
{
    public function store(ComentarioRequest $request){
        $validated = $request->validated();
        $comentario = Comentario::create($validated);
        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }

    public function update(Produto $produto, Comentario $comentario, ComentarioRequest $request){
        
        $comentario = Comentario::where('id',$request->submit)
        ->where('comentario_usuario_id', auth()->user()->id)
        ->first();
        
        $validated = $request->validated();
        if($validated && $comentario){
            $comentario->update($validated);
            return redirect()->back()->with('success','Mensagem alterada com sucesso');
        }
        abort(403);
    }

    public function destroy(Request $request, Comentario $comentario){
        if($comentario->comentario_usuario_id == auth()->user()->id){
            $comentario->delete();
            return redirect()->back()->with('success','Comentário excluído');
        }
        abort(403);
    }

}
