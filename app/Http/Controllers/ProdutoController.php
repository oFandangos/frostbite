<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Comentario;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProdutoController extends Controller
{
    public function show(Produto $produto){
        $autor = Auth::user();
        $user = User::where('id','=', $produto->user_id)
        ->select('users.email', 'users.id')
        ->first();

        $comentario = Comentario::select('comentarios.id','comentarios.created_at','comentarios.comentario','comentarios.comentario_usuario_id')->where('produto_id', '=', $produto->id)
        ->join('users', 'comentarios.comentario_usuario_id', '=', 'users.id')
        ->get();

        return view('prod.show', ['produto' => $produto, 'autor' => $autor, 'user' => $user, 'comentarios' => $comentario]);
    }
        
    public function create(Produto $produto, Category $categories, User $users){
            $userId = Auth::id();
            Gate::authorize('create', $produto);
            return view('prod.create')->with(['produto' => $produto, 'categories' => $categories, 'users' => $users, 'userId' => $userId]);
    }

    public function store(ProdutoRequest $request, Produto $produto, Category $category, User $user){
        $produto = new Produto;
        $produto->nome_prod = $request->nome_prod;
        $produto->valor_prod = $request->valor_prod;
        $produto->category_id = $request->category_id;
        $produto->user_id = $request->user_id;
        $produto->save();
        request()->session()->flash('alert-success','Produto Cadastrado com sucesso! Esperando análise administrativa.');
        return redirect("/produto/show/{$produto->id}");
    }

    public function edit(Produto $produto, User $user, Category $categories){

        Gate::authorize('edit', $produto);

        return view('prod.edit', ['produto' => $produto, 'categories' => $categories]);
    }

    public function update(ProdutoRequest $request, Produto $produto){
        $produto->nome_prod = $request->nome_prod;
        $produto->valor_prod = $request->valor_prod;
        $produto->category_id = $request->category_id;
        $produto->save();
        request()->session()->flash('alert-success','Produto alterado com sucesso!');
        return redirect("/produto/show/{$produto->id}");
    }

    public function destroy(Produto $produto){
        $produto->delete();
        request()->session()->flash('alert-success','Produto excluído!');
        return redirect("/");
    }
}
