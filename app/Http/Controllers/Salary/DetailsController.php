<?php

namespace App\Http\Controllers\Salary;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function index()
    {
        $table = Employee::all();
        return view('salary.all_salary')->with(['table' => $table]);
    }

    public function payment_details($id){

        $table = Employee::find($id);
        return view('salary.salary_details')->with(['table' => $table]);
    }
}
