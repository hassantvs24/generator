<?php

namespace App\Http\Controllers\Reports;

use App\Bankbook;
use App\Banks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankbookController extends Controller
{
    public function index()
    {
        $table = Banks::all();
        return view('reports.bankbook')->with(['table' => $table]);
    }

    public function show(Request $request){

        $date_rang = date_time_range($request->dateRang);
        $table = Bankbook::whereBetween('created_at', [$date_rang[0], $date_rang[1]])->get();

        return view('print.reports.bankbook.bankbook')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }

    public function bank_show(Request $request){
        $bank = Banks::find($request->bankID);

        $date_rang = date_time_range($request->dateRang);
        $pre_table = Bankbook::whereBetween('created_at', [$date_rang[0], $date_rang[1]]);
        $pre_table->where('bankID', $request->bankID);
        $table = $pre_table->get();

        return view('print.reports.bankbook.bank_reports')->with(['table' => $table, 'date_rang' =>  $request->dateRang, 'bank' => $bank]);
    }

}
