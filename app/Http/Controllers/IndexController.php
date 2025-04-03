<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Category;
use App\Models\User;
use App\Models\Aviso;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{

    
    public function index(Request $request, User $users, Category $categories){
        $apiKey = env('API_KEY');
        $city = 'São Paulo,br';
        $temperatura = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID='.$apiKey.'&units=metric');
        $icon = $temperatura['weather'][0]['icon'];

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
        $avisos = Aviso::orderBy('created_at','desc')->paginate(3);

        return view('index', [
            'produtos' => $produtos,
            'users' => $users, 
            'avisos' => $avisos,
            'categories' => $categories,
            'temperatura' => $temperatura,
            'icon' => $icon
            ]);

    }
}
