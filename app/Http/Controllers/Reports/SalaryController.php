<?php

namespace App\Http\Controllers\Reports;

use App\Employee;
use App\EmployeeTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        return view('reports.salary')->with(['employee' => $employee]);
    }


    public function employee_ledger(Request $request){
        $employee = Employee::find($request->employeeID);

        $date_rang = date_time_range($request->dateRang);
        $table = EmployeeTransaction::where('employeeID', $request->employeeID)->whereBetween('created_at', [$date_rang[0], $date_rang[1]])->get();


        return view('print.reports.salary.salary')->with(['table' => $table, 'date_rang' =>  $request->dateRang,  'employee' => $employee]);
    }

}
