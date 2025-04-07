<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        Gate::authorize('category');
        return view('cat.index', ['categories' => $categories]);
    }
    
    public function create(Category $category){
        Gate::authorize('is_admin');
        return view('cat.create');
    }

    public function store(Request $request, Category $category){
        $category = new Category;
        $category->nome_cat = $request->nome_cat;
        $category->save();
        return redirect('/cat');
    }

    public function edit(Category $category){
        Gate::authorize('is_admin');
        return view('cat.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category){
        $category->nome_cat = $request->nome_cat;
        $category->save();
        return redirect("/cat");
    }

    public function destroy(Category $category){
        Gate::authorize('is_admin');
        $category->delete();
        return redirect('/cat');
    }
}
