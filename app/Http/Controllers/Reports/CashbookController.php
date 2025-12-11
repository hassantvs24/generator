<?php

namespace App\Http\Controllers\Reports;

use App\Cashbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashbookController extends Controller
{
    public function index()
    {
        return view('reports.cashbook');
    }

    public function show(Request $request){

        $date_rang = date_time_range($request->dateRang);
        $table = Cashbook::whereBetween('created_at', [$date_rang[0], $date_rang[1]])->get();

        return view('print.reports.cashbook.cashbook')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }
}
