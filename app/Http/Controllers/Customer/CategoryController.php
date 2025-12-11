<?php

namespace App\Http\Controllers\Customer;

use App\CustomerCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $table = CustomerCategory::all();
        return view('customer.category')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new CustomerCategory();
        $table->name = $request->name;
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = CustomerCategory::find($request->id);
        $table->name = $request->name;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }


    public function del($id){
        $table = CustomerCategory::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }


}
