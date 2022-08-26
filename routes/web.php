<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SoutenanceController;

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
})->name('connecter');


Route::get('/mot-de-passe-oublie',function(){
    return view('login.mot_de_passe_oublie');
})->name('mot_de_passe_oublie');



Route::post('mdp-oublie',[UserController::class,'mdp_oublie'])->name('mdp_oublie');
Route::patch('mdp-oublie/modifier',[UserController::class,'modifier_mdp_oublie'])->name('modifier_mdp_oublie');
Route::post('/connexion',[AuthenticatedSessionController::class, 'store'])->name('connexion');

Route::get('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('deconnexion');

Route::get('connexion/modifier_coordonnes',[UserController::class,'index'])->middleware('auth');
Route::get('connexion/renvoi-code',[UserController::class,'renvoi_code'])->name('renvoi_code');
Route::patch('connexion/modifier_coordonnes/modifier',[UserController::class,'edit'])
        ->middleware('auth')
        ->name('modifier_coordonnes');

/*Route::post('connexion/verifier_code/{code}',[UserController::class,'verifier_code'])
        ->middleware('auth')
        ->name('verifier_code');*/

Route::view('/modifier_mdp','login.modifier_mdp')
            /*->middleware([EnsureUserIsActive::class])*/->name('modifier_mdp');

require __DIR__.'/auth.php';
