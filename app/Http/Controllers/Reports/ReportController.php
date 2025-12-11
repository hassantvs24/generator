<?php

namespace App\Http\Controllers\Reports;

use App\CustomerTransaction;
use App\EmployeeTransaction;
use App\InOutTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.profit_lose');
    }

    public function profit_lose(Request $request){

        $xyz = explode(', ', $request->dateRang);
        $m = date('m', strtotime($xyz[0]));
        $dates = '01-'.$m.'-'.$xyz[1];

        $dateRangs = date('d/m/Y', strtotime($dates)).' - '.date('t/m/Y', strtotime($dates));
        $date_rang = date_time_range($dateRangs);

        $bill_collection = CustomerTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])->sum('amountIN');
        $salary_pay = EmployeeTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])->sum('amountOut');
        $all_income = InOutTransaction::where('transactionType', 'IN')->whereBetween('created_at', [$date_rang[0], $date_rang[1]])->sum('amountIN');
        $all_expance = InOutTransaction::where('transactionType', 'OUT')->whereBetween('created_at', [$date_rang[0], $date_rang[1]])->sum('amountOut');

        return view('print.reports.profit_lose.profit_lose')->with([ 'months' => $request->dateRang, 'bill_collection' => $bill_collection, 'salary_pay' => $salary_pay, 'all_income' => $all_income, 'all_expance' => $all_expance]);
    }

}
