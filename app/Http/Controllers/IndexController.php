<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function pesquisa(){
    $query = Produto::join('users','produtos.user_id','users.id')
    ->where('produtos.nome_prod','like','%'.request()->input .'%')
    ->where('produtos.status','Aprovado')
    ->select('produtos.id','produtos.nome_prod','users.name','produtos.valor_prod')
    ->get()
    ->toArray();
        if(!empty($query)){
            return response()->json($query);
        }else{
            return [];
        }
    }
    
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

        return view('index', [
            'produtos' => $produtos,
            'categories' => $categories,
            ]);

    }
}
