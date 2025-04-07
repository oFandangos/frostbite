<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{

use AuthenticatesUsers;
    
    protected $redirectTo = '/';
    

    public function authenticated(Request $request){
        $codBan = trim($request->email);
        $userBan = User::where('is_banned',TRUE)->where('email',"$codBan")->first();
        if(isset($userBan->is_banned)){
            auth()->logout();
            request()->session()->flash('alert-danger',"Esta coisa foi banida: $userBan->justificativa");
        }
    }

    public function username(){
        $user = User::where('email',request()->email)->first();
        if($user->email_verified_at != null){
            return 'email';
        }
        request()->session()->flash('alert-danger','E-mail Não autenticado');
        
    }
    public function index(User $users){
        return view('auth.login', ['users' => $users]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
