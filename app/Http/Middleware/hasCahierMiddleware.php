<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Stage;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class hasCahierMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        $ens=Enseignant::where('user_id',$user->id)->get()[0];
        $nbr_stages=Stage::where([['enseignant_id'=>$ens->id],['cahier_stage_id','!=',null]])->get()->count();
        if($nbr_stages>0){
            return $next($request);
        }else return back();

    }
}