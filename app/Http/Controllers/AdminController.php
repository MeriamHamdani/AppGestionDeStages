<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use PHPUnit\Util\Json;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $adminIsActive=array();
        //dd($adminIsActive);
        $admins=Admin::all();
        //dd($admins);
        $i=0;
        foreach($admins as $admin){
            $user=User::find($admin->user_id);
            
            $adminIsActive[$i]=array( 
                "admin" => $admin,
                "user"=>$user,
                
              );

            $i++;
         
        }
        //dd($adminIsActive);



        return view('admin.administration.liste_des_admin', compact(['adminIsActive']));
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
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    /*public function showAll()
    {

        $users=User::where('role','admin')->get();
        dd($users);
        $admins=Admin::all();
        return view('admin.etablissement.departement.liste_des_admin', compact(['admins']));
    }*/


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'numero_telephone'=>['required', 'string', 'max:8','min:8'],
            'numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        //dd($request);
        $user=new User();
        $user->numero_CIN=$request->numero_CIN;
        $user->password = Hash::make($request->numero_CIN);
        $user->is_active=false;
        $user->assignRole('admin');
        event(new Registered($user));
        $user->save();

        $admin=new Admin();
        $admin->nom=$request->nom;
        $admin->prenom=$request->prenom;
        $admin->email=$request->email;
        $admin->numero_telephone=$request->numero_telephone;
        $admin->user_id=$user->id;
$admin->save();

        return redirect()->action([AdminController::class,'index']);
        //return redirect()->route('liste_admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id_admin)
    {
        $admin=Admin::findOrFail($id_admin);
        $user=User::findOrFail($admin->user_id);
        return view('admin.administration.modifier_infos_admin', compact(['admin','user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_admin)
    {
        
        $admin=Admin::findOrFail($id_admin);
         $user=User::findOrFail($admin->user_id);
         $cin=$user->numero_CIN;
         //dd($request->all());
        
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'numero_telephone'=>['required', 'string', 'max:8','min:8'],
            //'numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],
        ]);
        
        if($cin !==$request->numero_CIN){
            $request->validate(['numero_CIN'=>['required', 'string', 'max:8','min:8', 'unique:users'],]);
            $user->numero_CIN=$request->numero_CIN;
            $user->update();
        }
        
        $admin->nom=$request->nom;
        $admin->prenom=$request->prenom;
        $admin->email=$request->email;
        $admin->numero_telephone=$request->numero_telephone;
        $admin->update();
        return redirect()->action([AdminController::class,'index']);
           
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_admin)
    {
        $admin=Admin::findOrFail($id_admin);
        $user=User::findOrFail($admin->user_id);
       
        $admin->delete();
        $user->delete();
        return redirect()->action([DepartementController::class, 'showAll']);


   }
   public function activer_desactiver($id){
       $user=User::findOrFail($id);
       $user->is_active=!($user->is_active);
       $user->update();
       return redirect()->action([AdminController::class,'index']);
   }
}