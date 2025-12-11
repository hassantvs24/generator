<?php

namespace App\Http\Controllers\Expense;

use App\InOutCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $table = InOutCategory::where('inOutType', 'OUT')->get();
        return view('income_expense.expense_category')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new InOutCategory();
        $table->name = $request->name;
        $table->inOutType = 'OUT';
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
