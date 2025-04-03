<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

use AuthenticatesUsers;
    
    protected $redirectTo = '/';
    

    public function authenticated(Request $request, User $userBan){
        $codBan = trim($_POST['codpes']); //trim remove espaços. O user colocava espaço antes do num e logava
        $userBan = User::where('is_banned',TRUE)->where('codpes','=',"$codBan")->first();
        if(isset($userBan->is_banned)){
            auth()->logout();
            request()->session()->flash('alert-danger',"Esta coisa foi banida: $userBan->justificativa");
        }else{

        }
    }

    public function username(){

        $codExists = Auth::user();

        if($codExists != false && $codExists->is_banned != true){
        $cod = trim($_POST['codpes']);
        $user = User::where('codpes','LIKE', "%$cod%")->select('name')->first();
        $items = explode(" ", $user->name); //metodo explode: está a separar o nome por espaços.
        $firstName = $items[0]; //pegando o primeiro item: o primeiro nome
        
        request()->session()->flash("alert-success","Bem-vindo, $firstName.");
        
    }
    return 'codpes';
    }

    public function index(User $users){
        return view('auth.login', ['users' => $users]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
