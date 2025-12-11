<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $table = Area::all();

        return view('area')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new Area();
        $table->name = $request->name;
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = Area::find($request->id);
        $table->name = $request->name;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }


    public function del($id){
        $table = Area::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }

}
