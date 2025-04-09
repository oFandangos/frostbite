<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewsletterMail;

class NewsletterController extends Controller
{
    public function create(Newsletter $newsletter, User $user){
        Gate::authorize('is_admin');
        $user = Auth::user();
        return view('user.adm.newsletter.create', ['newsletter' => $newsletter, 'user' => $user ]); //user = criador do aviso
    }

    public function store(Request $request, Newsletter $newsletter, User $user){
        
        Gate::authorize('is_admin');
        
        $newsletter->titulo = $request->titulo;
        $newsletter->texto = $request->texto;
        $newsletter->user_id = $request->user_id;
        $newsletter->save();        

        $destinatarios = User::where('newsletters',1)
        ->where('email_verified_at','<>', null)
        ->get();
        foreach($destinatarios as $destinatario){
            //passar pra algum cron...
            #Mail::to($destinatario->email)->queue(new SendNewsletterMail($newsletter));
        }
        Mail::to('eu@gmail.com')->queue(new SendNewsletterMail(['titulo' => 'oi', 'text' => 'oie']));
        
        request()->session()->flash('alert-success','Newsletter enviado com sucesso');
        return redirect('/user');
    }
}
