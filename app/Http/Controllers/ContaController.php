<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\Gate;
use App\Mail\sendPasswordMail;
use Illuminate\Support\Facades\Mail;

class ContaController extends Controller
{
    
    public function index(Request $request, User $user, Produto $produtos){
        if(Gate::allows('isuser', $user)){
            $auth = Auth::user();
            $user = User::select('*')->where('id','=', $auth->id)->first();
            return view('conta.index', compact('user', 'auth'));
        }else{
            request()->session()->flash('alert-danger','Usuário sem permissão');
            return redirect('/');
        }
    }

    public function cadastrarView(){
        return view('conta.cadastrar');
    }

    public function store(){
        dd('po');
    }

    public function recuperarSenhaView(){
        return view('conta.recuperar-senha');
    }

    public function sendMail(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            $user->password = bcrypt(md5("$user->created_at"));
            $user->update();
            Mail::to($user->email)->send(new sendPasswordMail($user));

            request()->session()->flash('alert-success','Email enviado com sucesso');
            return redirect()->back();
        }else{
            request()->session()->flash('alert-danger','Email não encontrado');
            return redirect('/recuperar-senha');
        }
    }

}
