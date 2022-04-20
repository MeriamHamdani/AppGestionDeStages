<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('login.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $attributes = request()->validate([
            'numero_CIN' => 'required',
            'password' => 'required'

        ]);
        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }
        session()->regenerate();
        return redirect()->intended($this->accueil());

    }

    public function accueil() :string{
        if (Auth::user()) {
            $roles=Auth::user()->getRoleNames();
            foreach ($roles as $r) {
                switch ($r) {
                    case 'admin':
                        //$role='admin';
                        return ('admin/administration/liste-admin');
                        break;
                    case 'enseignant':
                        //$role='enseignant';
                        return ('enseignant/');
                        break;
                    case 'etudiant':
                       // $role='etudiant';

                        return ('etudiant/stage/demandes-stages');
                        break;
                }
            }
        }
        return 'ok';
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');


  }
}