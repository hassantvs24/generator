<?php

namespace App\Http\Controllers\Salary;

use App\Cashbook;
use App\Employee;
use App\EmployeeTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SheetController extends Controller
{
    public function index()
    {
        $table = Employee::where('balance', '>', 0)->get();
        return view('salary.payment')->with(['table' => $table]);
    }

    public function payment_details($id){
        $table = Employee::find($id);
        return view('salary.payment_details')->with(['table' => $table]);
    }


    public function payment(Request $request){
        DB::beginTransaction();
        try {
            if($request->amount > 0){

                $table = Employee::find($request->employeeID);
                $old_balance = $table->balance;
                $new_balance = $old_balance - $request->amount;
                $table->balance = $new_balance;
                $table->save();

                //**************Transaction Table****************
                $transaction = new EmployeeTransaction();
                $transaction->employeeID = $request->employeeID;
                $transaction->amountOut = $request->amount;
                $transaction->transactionType = 'OUT';
                $transaction->descriptions = serialize(['sector' =>'Salary', 'transactionType' => 'Monthly Salary Payment']);
                $transaction->created_at = db_date($request->created_at).' '.date('H:i:s');
                $transaction->save();

                $transactionID = $transaction->empTransactionID;
                //**************Transaction Table****************

                //**************Cashbook Table****************
                $cashbook = new Cashbook();
                $cashbook->descriptions = serialize(['sector' =>'Salary', 'description' => 'Salary Payment', 'employee' => $request->employeeID, 'transactionID' => $transactionID]);
                $cashbook->amountOut = $request->amount;
                $cashbook->transactionType = 'OUT';
                $cashbook->created_at = db_date($request->created_at).' '.date('H:i:s');
                $cashbook->save();
                //**************Cashbook Table****************


            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }


    public function payment_edit(Request $request){
        DB::beginTransaction();
        try {

            if($request->amount == 0){
                $table = EmployeeTransaction::find($request->id);
                $out_amount = $table->amountOut;
                $employeeID = $table->employeeID;


                $employee = Employee::find($employeeID);
                $old_balance = $employee->balance;
                $new_balance = $old_balance + $out_amount;
                $employee->balance = $new_balance + $request->amount;
                $employee->save();


                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Salary%description%Salary Payment%employee%'.$employeeID.'%transactionID%'.$request->id.'%')->where('transactionType', 'OUT')->delete();
                //**************Cashbook Table****************


                $table->delete();
            }else{
                $table = EmployeeTransaction::find($request->id);
                $out_amount = $table->amountOut;
                $employeeID = $table->employeeID;
                $table->amountOut = $request->amount;



                $employee = Employee::find($employeeID);
                $old_balance = $employee->balance;
                $new_balance = $old_balance + $out_amount;
                $employee->balance = $new_balance - $request->amount;
                $employee->save();

                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Salary%description%Salary Payment%employee%'.$employeeID.'%transactionID%'.$request->id.'%')
                    ->where('transactionType', 'OUT')
                    ->update([
                    'amountOut' => $request->amount
                ]);
                //**************Cashbook Table****************

                $table->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }


    public function payment_del($id){
        DB::beginTransaction();
        try {

            $table = EmployeeTransaction::find($id);
            $out_amount = $table->amountOut;
            $employeeID = $table->employeeID;


            //**************Customer Table****************
            if($out_amount > 0){
                $employee = Employee::find($employeeID);
                $old_balance = $employee->balance;
                $new_balance = $old_balance + $out_amount;
                $employee->balance = $new_balance;
                $employee->save();
            }

            //**************Customer Table****************

            //**************Cashbook Table****************
            Cashbook::where('descriptions', 'like', '%sector%Salary%description%Salary Payment%employee%'.$employeeID.'%transactionID%'.$id.'%')->where('transactionType', 'OUT')->delete();
            //**************Cashbook Table****************

            $table->delete();


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }

}
