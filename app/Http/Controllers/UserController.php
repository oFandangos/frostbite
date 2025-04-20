<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request, User $users){
        Gate::authorize('is_admin');
            $query = User::orderBy('name','desc');
            if($request->search){
                $query->where(function($query) use ($request){
                    $query->orWhere('name','LIKE','%'.$request->search.'%')
                    ->orWhere('codpes', $request->search)
                    ->get();
                });
            }
            $users = $query->get();
            
        return view('user.index', [
            'users' => $users,
        ]);
    }

    //formulario de cadastro
    public function edit(Request $request, User $user){
        Gate::authorize('is_admin');
        return view ('user.create', ['user' => $user]);
    }

    //atualização de adm
    public function update(UserRequest $request, User $user){
        $userLogado = Auth::user();
        $user = User::where('codpes', '=', $request->codpes)->first();
        if($user->is_banned == false){
            if($user->codpes == $userLogado->codpes){
                return redirect('/user')->with('error','Não é possivel alterar o proprio admin');
            }else{
                $user->codpes = $request->codpes;
                $user->is_admin = $request->is_admin;
                $user->save();
                if($user->is_admin == true){
                    return redirect('/user')->with('success','Usuario cadastrado como admin');
                }else{
                    return redirect('/user')->with('error',"Administrador do usuário ".$user->name." - ".$user->codpes." removido");
                }
            }
        }else{
            return redirect('/user')->with('error', 'Não é possível cadastrar um usuário banido como admin');
        }
    }

    public function banir(Request $request, User $user){
        Gate::authorize('is_admin');
        return view('user.banir', ['user' => $user]);

    }

    #funcao para banir um usuario
    public function delete(UserRequest $request, User $user){
        $userLogado = Auth::user();
        $user = User::where('codpes', '=', $request->codpes)->first();
        if($user->codpes == $userLogado->codpes){
            return redirect('/user')->with('error','Não é possível banir a si mesmo');
        }elseif($user->is_banned == true && $request->is_banned == true){
            return redirect('/user')->with('error','Usuario já banido');
        }else{
            $user->codpes = $request->codpes; //tirar o codpes para impedir o usuario de logar; mostrar mensagem de erro caso tente logar
            $user->justificativa = $request->justificativa;
            $user->is_banned = $request->is_banned;
            $user->is_admin = false;
            $user->save();
            if($request->is_banned == true){
                return redirect('/user')->with('success','Usuário "'."$user->name". '" - '. $user->codpes .' banido');
            }else{
                return redirect('/user')->with('success', 'Usuário "'. "$user->name". '" - '. $user->codpes .' desbanido');
            }
        }
    }
}
