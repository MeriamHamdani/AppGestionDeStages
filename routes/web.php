<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
@include('admin_web.php');
@include('etudiant_web.php');
@include('enseignant_web.php');

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',function(){
    return view('login.login');
});
//dd(Auth::user());

Route::get('/connexion',[AuthenticatedSessionController::class, 'store'])->name('connexion');

Route::get('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('deconnexion');


Route::view('/modifier_mdp','login.modifier_mdp')
            /*->middleware([EnsureUserIsActive::class])*/->name('modifier_mdp');

require __DIR__.'/auth.php';