<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\MdpOublieNotification;
use App\Notifications\FirstLoginNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth()->user();
        return view('user/modifier_coordonnes',compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user=Auth::user();
        //dd($request->new_password,$request->new_password2);
        if($request->aVerifier===(string)$request->code){
            if($request->new_password==$request->new_password2)
        {
            $user->password=bcrypt($request->new_password);
            $user->is_active=1;
            $user->update();
            return redirect('deconnexion');
        }
        else  {
            Session::flash('message', 'no-change');
            return back();
        }
        }else{
            Session::flash('message', 'code_invalide');
            return back();
        }


    }

    /*public function verifier_code($code, Request $req){
        if($req->aVerif===(string)$code){

            return view('user.modifier_coordonnes');
        }
        Session::flash('message','invalide');
    }*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mdp_oublie(Request $request){
        //dd($request->numero_CIN);
        if(User::where('numero_CIN',$request->numero_CIN)->exists()){
            $user=User::where('numero_CIN',$request->numero_CIN)->get()[0];
            $code = random_int(100000, 999999);
                session(['code' => $code,'msg'=> 'ok']);
                $user->notify(new MdpOublieNotification($code));
                return view('login.modifier_mdp_oublie',compact('user'));


        }else{
            Session::flash('message','CIN introuvable');
            return view('login.mot_de_passe_oublie');
        }
    }
    public function modifier_mdp_oublie(Request $request){
//dd($request->user_id);
        if($request->aVerifier === $request->code){
            if($request->new_password==$request->new_password2){
                $user=User::find($request->user_id);
                $user->password=bcrypt($request->new_password);

                $user->update();
            return redirect('/');
            }else{
                Session::flash('message', 'no-change');
            return back();
            }
        }else{
            Session::flash('message', 'code_invalide');
            return back();
        }
    }
}