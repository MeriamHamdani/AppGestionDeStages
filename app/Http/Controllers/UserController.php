<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
}