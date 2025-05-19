<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Comentario;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\CategoryController;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProdutoController extends Controller
{

    public function index(Request $request, Category $categories){

        $query = Produto::orderBy('produtos.nome_prod','desc')
        ->join('users','produtos.user_id','=','users.id')
        ->join('categories','produtos.category_id','=','categories.id')
        ->select('produtos.*','users.name', 'categories.nome_cat')
        ->where('produtos.status','aprovado');
        
        if($request->nomecategoria != ''){
            $query->where('categories.nome_cat', $request->nomecategoria);
        }

        if($request->search != ''){
            $query->where(function($query) use ($request){
                $query->orWhere('produtos.nome_prod','LIKE','%'.$request->search.'%');
            });
        }
        $produtos = $query->get();

        return view('prod.index', [
            'produtos' => $produtos,
            'categories' => $categories,
            ]);

    }

    public function show(Produto $produto){
        $autor = Auth::user();
        $user = User::where('id','=', $produto->user_id)
        ->select('users.email', 'users.id')
        ->first();

        $comentario = Comentario::select('comentarios.id','comentarios.created_at','comentarios.comentario','comentarios.comentario_usuario_id')->where('produto_id', '=', $produto->id)
        ->get();

        return view('prod.show', ['produto' => $produto, 'autor' => $autor, 'user' => $user, 'comentarios' => $comentario]);
    }
        
    public function create(Produto $produto, Category $categories, User $users){
        $userId = Auth::id();
        Gate::authorize('create', $produto);
        return view('prod.create')->with(['produto' => $produto, 'categories' => $categories, 'users' => $users, 'userId' => $userId]);
    }

    public function store(ProdutoRequest $request, FileRequest $fileRequest){
        
        $validated = $request->validated();
        $produto = Produto::create($validated);

        $validatedFile = $fileRequest->validated();
        $validatedFile['produto_id'] = $produto->id;
        $validatedFile['original_name'] = $request->file('arquivo')->getClientOriginalName();
        $validatedFile['path'] = $request->file('arquivo')->store('.');
        $file = File::create($validatedFile);
        return redirect("/produto/show/{$produto->id}")->with('success',"Produto criado com sucesso!" );
    }

    public function edit(Produto $produto, User $user, Category $categories){
        Gate::authorize('edit', $produto);
        return view('prod.edit', ['produto' => $produto, 'categories' => $categories]);
    }

    public function update(ProdutoRequest $request, Produto $produto){
        Gate::authorize('edit',$produto);
        $validated = $request->validated();
        $produto->update($validated);
        return redirect("/produto/show/{$produto->id}")->with('success','Produto alterado com sucesso!');
    }

    public function destroy(Produto $produto){
        $produto->delete();
        request()->session()->flash('alert-success','Produto excluído!');
        return redirect("/");
    }
}
