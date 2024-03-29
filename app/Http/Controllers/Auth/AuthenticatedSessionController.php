<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AnneeUniversitaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\FirstLoginNotification;
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
    public function store(Request $request)
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
            session(['annee' => $this->current_annee_univ()]);
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
                        return ('admin/dashboard');
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
                        return ('admin/dashboard');
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

    static function current_annee_univ()
    {

        $mydate = Carbon::now();
        $moisCourant = (int)$mydate->format('m');
        if ((6 < $moisCourant) && ($moisCourant < 12)) {
            $annee = '20' . $mydate->format('y') . '-20' . strval(((int)$mydate->format('y')) + 1);
        } else {
            $annee = '20' . strval(((int)$mydate->format('y')) - 1) . '-20' . $mydate->format('y');
        }
        $annees = AnneeUniversitaire::all();
        foreach ($annees as $a) {
            if ($a->annee == $annee) {
                return $a;

            }
        }

    }
}
