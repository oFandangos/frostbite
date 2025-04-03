<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;

class AdminProdController extends Controller
{
    public function index(Produto $produtos, User $users){
        if(Gate::allows('create-user')){
        $produtos = Produto::join('users','produtos.user_id','=','users.id')
        ->select('produtos.*', 'users.email');
        
        return view('user.adm.produtos', [
            'produtos' => $produtos->where('status','em_analise')->get(),
            'users' => $users
        ]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    public function update(Request $request, Produto $produto){
        
        $produto->status = $request->status;
        $produto->save();
        request()->session()->flash('alert-success','produto aprovado');
        return redirect('/adm/prod-listar');
    }

    public function reprovar(Request $request, Produto $produto){
        $produto->status = $request->status;
        $produto->justificativa_reprovado = $request->justificativa_reprovado;
        $produto->save();
        request()->session()->flash('alert-warning','produto reprovado');
        return redirect('/adm/prod-listar');
    }

    public function retornar(Request $request, Produto $produto){
        $produto->status = $request->status;
        // $produto->justificativa_reprovado = $request->justificativa_reprovado;
        $produto->save();
        request()->session()->flash('alert-warning','produto retornado ao usuário');
        return redirect('/adm/prod-listar');
    }
}
