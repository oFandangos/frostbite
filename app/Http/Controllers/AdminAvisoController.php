<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aviso;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class AdminAvisoController extends Controller
{
    public function create(Aviso $aviso, User $user){
        $user = Auth::user();
        return view('user.adm.avisos', ['aviso' => $aviso, 'user' => $user ]); //user = criador do aviso
    }

    public function store(Request $request, Aviso $aviso, User $user){
        $aviso->titulo = $request->titulo;
        $aviso->texto = $request->texto;
        $aviso->user_aviso_id = $request->user_aviso_id;
        $aviso->save();
        request()->session()->flash('alert-success','Aviso enviado com sucesso');
        return redirect('/user');
    }
}
