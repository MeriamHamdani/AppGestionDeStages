<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Auth::routes(['verify'=>true]);
Route::get('/',function(){
    return view('login.login');
})->name('connecter');
//dd(Auth::user());

Route::get('/connexion',[AuthenticatedSessionController::class, 'store'])->name('connexion');

Route::get('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('deconnexion');

Route::get('connexion/modifier_coordonnes',[UserController::class,'index'])->middleware('auth');

Route::patch('connexion/modifier_coordonnes/modifier',[UserController::class,'edit'])
        ->middleware('auth')
        ->name('modifier_coordonnes');

/*Route::post('connexion/verifier_code/{code}',[UserController::class,'verifier_code'])
        ->middleware('auth')
        ->name('verifier_code');*/

Route::view('/modifier_mdp','login.modifier_mdp')
            /*->middleware([EnsureUserIsActive::class])*/->name('modifier_mdp');

require __DIR__.'/auth.php';
