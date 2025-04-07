<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Produto;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //impede que um usuário acesse a view de edição de um produto, caso não seja o dele próprio. 
        Gate::define('edit', function (User $user, Produto $produto){
            return $user->id === $produto->user_id;
        });

        //usuário deve ser verdadeiro para poder criar um produto
        Gate::define('create', function (User $user, Produto $produto){
            return $user->id == true;
        });

        Gate::define('category', function (User $user){
            return $user->id == true;
        });

        Gate::define('create-user', function (User $user){
            return $user->is_admin == true; 
        });

        Gate::define('is_user', function (User $user){
            if(Auth::check()){
                $auth  = Auth::user();
                if($auth->email_verified_at != null){
                    return 'email';
                }else{
                    auth()->logout();
                    request()->session()->flash('alert-success','Deslogado com sucesso');
                }
            }else{
                dd('o');
                return redirect('/')->with('alert-danger','Usuário sem permissão');
            }
        });

        Gate::define('is_admin', function (User $user){
            if(Auth::user()){
                $admins = $user::where('is_admin',1)
                ->where('codpes',Auth::user()->codpes)
                ->get();
                foreach($admins as $admin){
                    #dd('vc é adm');
                    return $admin->codpes == Auth::user()->codpes;
                }
            }
            #dd('vc num é adm');
            return false;
        });

        Blade::directive('bootstrap', function () {
            return <<<'HTML'
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            HTML;
        });
    }
}
