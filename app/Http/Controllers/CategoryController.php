<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        if(Gate::allows('category')){
            return view('cat.index', ['categories' => $categories]);
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }
    
    public function create(Category $category){
        if(Gate::allows('create-user')){
            return view('cat.create');
            return redirect('/cat');
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    public function store(Request $request, Category $category){
        $category = new Category;
        $category->nome_cat = $request->nome_cat;
        $category->save();
        return redirect('/cat');
    }

    public function edit(Category $category){
        if(Gate::allows('create-user')){
            return view('cat.edit', ['category' => $category]);
            return redirect('/cat');
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    public function update(Request $request, Category $category){
        $category->nome_cat = $request->nome_cat;
        $category->save();
        return redirect("/cat");
    }

    public function destroy(Category $category){
        if(Gate::allows('create-user')){
            $category->delete();
            return redirect('/cat');
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }
}
