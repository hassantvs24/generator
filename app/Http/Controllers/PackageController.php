<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $table = Package::all();
        return view('package')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new Package();
        $table->name = $request->name;
        $table->packageAmount = $request->packageAmount;
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = Package::find($request->id);
        $table->name = $request->name;
        $table->packageAmount = $request->packageAmount;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }


    public function del($id){
        $table = Package::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }

}
