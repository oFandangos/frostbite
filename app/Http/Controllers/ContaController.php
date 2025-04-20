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
use App\Http\Requests\ContaRequest;
use App\Mail\SendConfirmationMail;
use Illuminate\Support\Str;

class ContaController extends Controller
{
    
    public function index(Request $request, User $user){
        Gate::authorize('is_user', $user);
        $auth = Auth::user();
        $user = User::select('*')->where('id','=', $auth->id)->first();
        return view('conta.index', compact('user', 'auth'));
    }

    public function cadastrarView(){
        return view('conta.cadastrar');
    }

    public function store(ContaRequest $request){
        $validated = $request->validated();
        if($validated){
            $validated['password'] = bcrypt($request['password']);
            $user = User::create($validated);
            Mail::to($request->email)->send(new SendConfirmationMail($user));
            return redirect()->back()->with('success','Usuário cadastrado com sucesso. Faça a confirmação por e-mail');
        }
        return redirect()->back()->with('error','Erro ao cadastrar usuário');
    }

    public function confirmarEmailView(){ //mensagem do email
        $email = User::where('email',request()->email)->first();
        return view('emails.confirmar_email', [$email => 'email']);
    }

    public function emailConfirmado(Request $request, $id){
        $user = User::findOrFail($id);
        Auth::login($user);
        $user->email_verified_at = now();
        $user->remember_token = Str::random(60);
        $user->save();
        return redirect('/')->with('success','E-mail confirmado com sucesso');
    }

    public function edit(User $user){
        return view('conta.edit', compact('user'));
    }

    public function update(ContaRequest $request, User $user){
        $validated = $request->validated();
        if($validated){
            $validated['password'] = bcrypt($request['password']);
            $user->update($validated);
        }
        request()->session()->flash('alert-success','Dados atualizados com sucesso');
        return redirect()->back();
    }

    public function recuperarSenhaView(){
        return view('conta.recuperar-senha');
    }
    //envia email para recuperação de senha
    public function sendMail(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            $user->password = bcrypt(md5("$user->remember_token")); //trocar para o hash
            $user->update();
            Mail::to($user->email)->send(new sendPasswordMail($user));
            request()->session()->flash('alert-success','Email enviado com sucesso');
            return redirect()->back();
        }else{
            request()->session()->flash('alert-danger','Email não encontrado');
            return redirect('/recuperar-senha');
        }
    }

    public function produtosUser(User $user){
        $produtos = Produto::where('user_id', $user->id)->get();
        return view('index', (['produtos' => $produtos, 'user' => $user, 'categories' => \App\Models\Category::class]));
    }

}
