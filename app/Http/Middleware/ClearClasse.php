<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Classe;
use App\Models\TypeStage;
use Illuminate\Http\Request;

class ClearClasse
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
        if(Classe::all()->count()>TypeStage::all()->count()){
            $types_stages_ids=TypeStage::all()->pluck('id')->toArray();

            $classes = Classe::all()->diff(Classe::whereIn('type_stage_id', $types_stages_ids)->get());
            foreach($classes as $classe){
                $classe->delete();
            }
            //dd($classes);
        }
        return $next($request);
    }
}