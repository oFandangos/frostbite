<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminProdController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\NewsletterController;
use App\Http\Middleware\AuthUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

Route::get('/',[IndexController::class,'index']);

#categorias
Route::get('/cat',[CategoryController::class,'index']);
Route::get('/cat/create',[CategoryController::class,'create']);
Route::post('/cat',[CategoryController::class,'store']);
Route::get('/cat/edit/{category}',[CategoryController::class,'edit']);
Route::put('/cat/{category}/edit',[CategoryController::class,'update']);
Route::delete('/cat/{category}',[CategoryController::class,'destroy']);

#Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class,'logout']);

Route::get('/conta', [ContaController::class, 'index']);
Route::get('/conta/edit/{user}', [ContaController::class, 'edit']);
Route::put('/conta/{user}/', [ContaController::class, 'update']);
Route::delete('/conta/delete/{user}', [ContaController::class, 'destroy']);
Route::get('/conta/produtos/{user}', [ContaController::class, 'produtosUser']);

Route::get('/cadastrar',[ContaController::class, 'cadastrarView']);
Route::post('/store',[ContaController::class, 'store']);

Route::get('/email_verificado/{id}', [ContaController::class, 'emailConfirmado'])
->name('email.confirmado');

Route::get('/teste/{id}/{hash}', [ContaController::class, 'confirmarEmailView'])->name('teste'); //excluir

// recuperar senha do usuário
Route::get('/recuperar-senha', [ContaController::class, 'recuperarSenhaView']);
Route::post('/recuperar', [ContaController::class, 'sendMail']);

#Produtos
Route::get('/produto/create',[ProdutoController::class,'create']);
Route::post('/produto',[ProdutoController::class,'store']);
Route::get('/produto/show/{produto}', [ProdutoController::class, 'show']);
Route::get('/produto/edit/{produto}',[ProdutoController::class,'edit']);
Route::put('/produto/{produto}/edit',[ProdutoController::class,'update']);
Route::delete('/produto/{produto}',[ProdutoController::class,'destroy']);


Route::post('/produto/comentar/{produto}', [ComentarioController::class, 'store']);
Route::delete('/produto/comentar/delete/{comentario}', [ComentarioController::class, 'destroy']);

#criacao de usuario por um admin
Route::get('/user', [UserController::class,'index']);
Route::get('/adm/create/{user}', [UserController::class,'edit']);
Route::put('/adm/{user}', [UserController::class,'update']);
Route::get('/adm/banir/{user}', [UserController::class, 'banir']);
Route::put('/adm/banido/{user}', [UserController::class,'delete']);

#avisos
Route::get('/newsletter/create', [NewsletterController::class, 'create']);
Route::post('/newsletter', [NewsletterController::class, 'store']);

#aprovar produtos
Route::get('/adm/prod-listar', [AdminProdController::class, 'index']); //form
Route::put('/adm/aprovar/{produto}', [AdminProdController::class, 'update']); //aprovar ou rejeitar um produto
Route::put('/adm/reprovar/{produto}', [AdminProdController::class, 'reprovar']);
Route::put('/adm/retornar/{produto}', [AdminProdController::class, 'retornar']);

Route::resource('files', FileController::class);