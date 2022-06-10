<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\FirstLoginNotification;
use Illuminate\Support\Facades\Session;
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
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {

        $attributes = request()->validate([
            'numero_CIN' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($attributes)) {
            //dd(!User::where('numero_CIN', request()->numero_CIN)->exists());
            if (!User::where('numero_CIN', request()->numero_CIN)->exists()) {
                //dd('tre');
               // Session::flash('message', 'pas de cin');
                Session::flash('message', 'pas de cin');
                return back();
            } else
                Session::flash('message', 'mdp icorrect');
            return back();
        } else {
            session()->regenerate();
            $user = Auth::user();

            if ($user['is_active'] == 0) {
                $code = random_int(100000, 999999);
                session(['code' => $code]);
                $user->notify(new FirstLoginNotification($code));

                return redirect()->intended('connexion/modifier_coordonnes');
            }
            return redirect()->intended($this->accueil());


        }

        //$user['is_active'] = 1;
        //$user->update(['is_active']);


    }

    public function accueil(): string
    {
        //dd(Auth::user()->getRoleNames());
        if (Auth::user()) {
            $roles = Auth::user()->getRoleNames();
            foreach ($roles as $r) {
                switch ($r) {
                    case 'admin':
                        //$role='admin';
                        return ('admin/administration/liste-admin');
                        break;
                    case 'enseignant':
                        //$role='enseignant';
                        return ('enseignant/encadrement/liste-demandes');
                        break;
                    case 'etudiant':
                        // $role='etudiant';
                        return ('etudiant/stage/demandes-stages');
                        break;
                    case 'superadmin':
                        // $role='etudiant';
                        return ('admin/administration/liste-admin');
                        break;


                }

            }

        }
        return 'ok';

    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
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
