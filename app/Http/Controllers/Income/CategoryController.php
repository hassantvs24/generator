<?php

namespace App\Http\Controllers\Income;

use App\InOutCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $table = InOutCategory::where('inOutType', 'IN')->get();
        return view('income_expense.income_category')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new InOutCategory();
        $table->name = $request->name;
        $table->inOutType = 'IN';
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = InOutCategory::find($request->id);
        $table->name = $request->name;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }

    public function del($id){
        $table = InOutCategory::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }
}
