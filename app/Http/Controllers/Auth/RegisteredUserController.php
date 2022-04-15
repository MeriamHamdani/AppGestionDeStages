<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'numero_telephone'=>['required', 'string', 'max:8','min:8'],
            'numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([

            'numero_CIN'=>$request->numero_CIN,
            'password' => Hash::make($request->numero_CIN),
'is_active'=>false
        ]);
        //$user->is_active=false;

        $user->assignRole('admin');


        $admin=new Admin();
$admin::create([[
    'nom' => $request->nom,
    'prenom' => $request->prenom,
    'email' => $request->email,
    'numero_telephone'=>$request->numero_telephone,
    'user_id'=>$user

]]);
//admin->user()->save($user);
        $admin->save();
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}