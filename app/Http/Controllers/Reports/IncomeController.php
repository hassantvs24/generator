<?php

namespace App\Http\Controllers\Reports;

use App\InOutCategory;
use App\InOutTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function index()
    {
        $table = InOutCategory::where('inOutType', 'IN')->get();
        return view('reports.income')->with(['table' => $table]);
    }

    public function show(Request $request){

        $date_rang = date_time_range($request->dateRang);
        $pre_table = InOutTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]]);
        if($request->filled('inoutcatergoryID')){
            $pre_table->where('inoutcatergoryID', $request->inoutcatergoryID);
        }
        $pre_table->where('transactionType', 'IN');
        $table = $pre_table->get();

        return view('print.reports.income.income')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }
}
