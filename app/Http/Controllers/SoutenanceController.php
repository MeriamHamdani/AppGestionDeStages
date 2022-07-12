<?php

namespace App\Http\Controllers;

use App\Models\Soutenance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SoutenanceController extends Controller
{
    public function index()
    {
        $soutenances=Soutenance::all();
        $stnc=array();

        foreach($soutenances as $soutenance){
            $stnc[]=[
                'date'=>$soutenance->date,
                'start'=>$soutenance->start,
                'salle'=>$soutenance->salle
            ];
        }

        return view('admin.soutenance.stnc',compact('stnc'));
    }


    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Soutenance::insert($insertArr);
        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Soutenance::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Soutenance::where('id',$request->id)->delete();

        return Response::json($event);
    }



}