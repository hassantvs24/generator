<?php

namespace App\Http\Controllers\Bank;

use App\Banks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankInfoController extends Controller
{
    public function index()
    {
        $table = Banks::orderBy('bankID', 'desc')->get();
        return view('bankbook.banks')->with(['table' => $table]);
    }


    public function save(Request $request){
        $table = new Banks();
        $table->name = $request->name;
        $table->accountNo = $request->accountNo;
        $table->branch = $request->branch;
        $table->contact = $request->contact;
        //$table->openingBalance = $request->openingBalance;
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = Banks::find($request->id);
        $table->name = $request->name;
        $table->accountNo = $request->accountNo;
        $table->branch = $request->branch;
        $table->contact = $request->contact;
        //$table->openingBalance = $request->openingBalance;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }


    public function del($id){
        $table = Banks::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }

}
