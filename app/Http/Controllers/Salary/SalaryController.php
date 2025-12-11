<?php

namespace App\Http\Controllers\Salary;

use App\Cashbook;
use App\Employee;
use App\EmployeeTransaction;
use App\Salary;
use App\SalaryMonth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {
        $table = SalaryMonth::all();
        return view('salary.salary')->with(['table' => $table]);
    }

    public function month_save(Request $request){
        
        $satate = explode(", ",$request->monthName);
        $month = date('m',strtotime($satate[0]));
        //dd(date('Y-m-d',strtotime($satate[1].'-'.$month.'-'.'01')));
        
        
        $months = date('Y-m-d',strtotime($satate[1].'-'.$month.'-'.'01'));

        $validator = SalaryMonth::where('monthName',$months)->count();

        if ($validator > 0) {
            return redirect()->back()->with(['message' => 'Oh! No duplicate entry or not valid date.',  'alert-type' => 'error']);
        }else{
            $table = new SalaryMonth();
            $table->monthName = $months;
            $table->save();
            return redirect()->back()->with(config('naz.save'));
        }

    }

    public function details($id){
        $table = Employee::where('status', 'Active')->orderBy('employeeID', 'DESC')->get();
        $months = SalaryMonth::find($id);
        return view('salary.details')->with(['table' => $table, 'months' => $months]);
    }


    public function del_month($id){
        DB::beginTransaction();
        try {

            $table = SalaryMonth::find($id);
            $salary_count = $table->salary()->count();

            if($salary_count > 0){


                $salary = $table->salary()->get();

                foreach ($salary as $row){

                    $pay_salary = Salary::find($row->salaryID);
                    $employeeID = $pay_salary->employeeID;
                    $amount = $pay_salary->amount;

                    //***********Employee table**********
                    $employee = Employee::find($employeeID);
                    $old_balance = $employee->balance;
                    $new_balance = $old_balance - $amount;
                    $employee->balance = $new_balance;
                    $employee->save();
                    //***********/Employee table**********


                    //**************Transaction Table****************
                    EmployeeTransaction::where('descriptions', 'like', '%sector%Salary%salaryID%'.$row->salaryID.'%')->where('transactionType', 'IN')->delete();
                    //**************Transaction Table****************



                    $pay_salary->delete();
                }

                $table->delete();

            }else{
                $table->delete();
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.del'));
    }


    public function generate(Request $request){
        $selected = $request->marks;
        $salaryAmount = $request->salaryAmount;
        $salaryMonthID = $request->salaryMonthID;

        if(count($selected) > 0){

            DB::beginTransaction();
            try {

                foreach ($selected as $employeeID){
                    $amount = $salaryAmount[$employeeID];

                    if($amount > 0){

                        //***********Salary table**********
                        $salary = new Salary();
                        $salary->salaryMonthID = $salaryMonthID;
                        $salary->employeeID = $employeeID;
                        $salary->amount = $amount;
                        $salary->save();

                        $salaryID = $salary->salaryID;
                        //***********/Salary table**********

                        //***********Employee table**********
                        $employee = Employee::find($employeeID);
                        $old_balance = $employee->balance;
                        $new_balance = $old_balance + $amount;
                        $employee->balance = $new_balance;
                        $employee->save();
                        //***********/Employee table**********

                        //**************Transaction Table****************
                        $transaction = new EmployeeTransaction();
                        $transaction->employeeID = $employeeID;
                        $transaction->amountIN = $amount;
                        $transaction->transactionType = 'IN';
                        $transaction->descriptions = serialize(['sector' =>'Salary', 'transactionType' => 'Monthly Salary', 'salaryID' => $salaryID]);
                        $transaction->save();
                        //**************Transaction Table****************
                    }

                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return redirect()->back()->with(config('naz.all_success'));
        }else{
            return redirect()->back()->with(['message' => 'Oh! No Monthly Salary Generated here. Because selected data not found.',  'alert-type' => 'info']);
        }

    }


    public function generate_edi(Request $request){

        if($request->amount > 0){
            DB::beginTransaction();
            try {
                $table = Salary::find($request->id);
                $employeeID = $table->employeeID;
                $amount = $table->amount;

                //***********Employee table**********
                $employee = Employee::find($employeeID);
                $old_balance = $employee->balance - $amount;
                $new_balance = $old_balance + $request->amount;;
                $employee->balance = $new_balance;
                $employee->save();
                //***********/Employee table**********

                //**************Transaction Table****************
                EmployeeTransaction::where('descriptions', 'like', '%sector%Salary%salaryID%'.$request->id.'%')
                    ->where('transactionType', 'IN')
                    ->update(['amountIN' => $request->amount]);
                //**************Transaction Table****************

                $table->amount = $request->amount;
                $table->save();

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
            return redirect()->back()->with(config('naz.edit'));
        }else{
            return redirect()->back()->with(['message' => 'If you want to bill amount 0. Please Delete it.',  'alert-type' => 'info']);
        }

    }



    public function generate_del($id){
        DB::beginTransaction();
        try {
            $table = Salary::find($id);
            $employeeID = $table->employeeID;
            $amount = $table->amount;

            //***********Employee table**********
            $employee = Employee::find($employeeID);
            $old_balance = $employee->balance;
            $new_balance = $old_balance - $amount;
            $employee->balance = $new_balance;
            $employee->save();
            //***********/Employee table**********

            //**************Transaction Table****************
            EmployeeTransaction::where('descriptions', 'like', '%sector%Salary%salaryID%'.$id.'%')->where('transactionType', 'IN')->delete();
            //**************Transaction Table****************


            $table->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.del'));

    }

    public function generate_print($id){
        $table = Salary::where('salaryMonthID', $id)->get();
        $months = SalaryMonth::find($id);
        return view('print.salary.details')->with(['table' => $table, 'months' => $months]);

    }

}
