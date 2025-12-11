<?php

namespace App\Http\Controllers;

use App\Billing;
use App\BillMonth;
use App\Customers;
use App\CustomerTransaction;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillGenerateController extends Controller
{
    public function index()
    {
        $table = BillMonth::all();
        return view('bill.generate')->with(['table' => $table]);
    }

    
    public function month_save(Request $request){

        $satate = explode(", ",$request->monthName);
        $month = date('m',strtotime($satate[0]));
        //dd(date('Y-m-d',strtotime($satate[1].'-'.$month.'-'.'01')));
        
        
        $months = date('Y-m-d',strtotime($satate[1].'-'.$month.'-'.'01'));

        $validator = BillMonth::where('monthName',$months)->count();

        if ($validator > 0) {
            return redirect()->back()->with(['message' => 'Oh! No duplicate entry or not valid date.',  'alert-type' => 'error']);
        }else{

            //$validator2 = BillMonth::withTrashed()->where('monthName',$months)->count();

            $table = new BillMonth();
            $table->monthName = $months;
            $table->save();
            return redirect()->back()->with(config('naz.save'));

            /*if($validator2 > 0){
                BillMonth::withTrashed()->where('monthName',$months)->restore();
                return redirect()->back()->with(config('naz.save'));
            }else{
                $table = new BillMonth();
                $table->monthName = $months;
                $table->save();
                return redirect()->back()->with(config('naz.save'));
            }*/
        }

    }


    public function details($id){
        $table = Services::where('status', 'Active')->orderBy('customerID', 'DESC')->orderBy('servicesID', 'DESC')->get();
        $months = BillMonth::find($id);
        return view('bill.details')->with(['table' => $table, 'months' => $months]);
    }


    public function del_month($id){
        DB::beginTransaction();
        try {

            $table = BillMonth::find($id);
            $bill_count = $table->billing()->count();

            if($bill_count > 0){


                    $billing = $table->billing()->get();

                    foreach ($billing as $row){

                        $bill = Billing::find($row->billingID);
                        $customerID = $bill->services['customerID'];
                        $amount = $bill->amount;

                        //***********Customer table**********
                        $customer = Customers::find($customerID);
                        $old_balance = $customer->balance;
                        $new_balance = $old_balance + $amount;
                        $customer->balance = $new_balance;
                        $customer->save();
                        //***********/Customer table**********

                        //**************Transaction Table****************
                        CustomerTransaction::where('descriptions', 'like', '%sector%Billing%billingID%'.$row->billingID.'%')->where('transactionType', 'OUT')->delete();
                        //**************Transaction Table****************

                        $bill->delete();
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
        $billAmount = $request->billAmount;
        $billMonthID = $request->billMonthID;
        
        if(count($selected) > 0){

            DB::beginTransaction();
            try {

                foreach ($selected as $servicesID){
                    $amount = $billAmount[$servicesID];
                    //***********Service table**********
                    $table = Services::find($servicesID);
                    $customerID = $table->customerID;
                    //***********/Service table**********
                    if($amount > 0){

                        //***********Billing table**********
                        $billing = new Billing();
                        $billing->billMonthID = $billMonthID;
                        $billing->servicesID = $servicesID;
                        $billing->amount = $amount;
                        $billing->serviceCharge = 0;
                        $billing->save();

                        $billingID = $billing->billingID;
                        //***********/Billing table**********

                        //***********Customer table**********
                        $customer = Customers::find($customerID);
                        $old_balance = $customer->balance;
                        $new_balance = $old_balance - $amount;
                        $customer->balance = $new_balance;
                        $customer->save();
                        //***********/Customer table**********

                        //**************Transaction Table****************
                        $transaction = new CustomerTransaction();
                        $transaction->customerID = $customerID;
                        $transaction->amountOut = $amount;
                        $transaction->transactionType = 'OUT';
                        $transaction->descriptions = serialize(['sector' =>'Billing', 'transactionType' => 'Monthly Billing', 'billingID' => $billingID]);
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
            return redirect()->back()->with(['message' => 'Oh! No Monthly Bill Generated here. Because selected data not found.',  'alert-type' => 'info']);
        }

    }


    public function generate_edi(Request $request){

        if($request->amount > 0){
            DB::beginTransaction();
            try {
                $table = Billing::find($request->id);
                $customerID = $table->services['customerID'];
                $amount = $table->amount;

                //***********Customer table**********
                $customer = Customers::find($customerID);
                $old_balance = $customer->balance + $amount;
                $new_balance = $old_balance - $request->amount;
                $customer->balance = $new_balance;
                $customer->save();
                //***********/Customer table**********

                //**************Transaction Table****************
                CustomerTransaction::where('descriptions', 'like', '%sector%Billing%billingID%'.$request->id.'%')
                    ->where('transactionType', 'OUT')
                    ->update(['amountOut' => $request->amount]);
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
            $table = Billing::find($id);
            $customerID = $table->services['customerID'];
            $amount = $table->amount;

            //***********Customer table**********
            $customer = Customers::find($customerID);
            $old_balance = $customer->balance;
            $new_balance = $old_balance + $amount;
            $customer->balance = $new_balance;
            $customer->save();
            //***********/Customer table**********

            //**************Transaction Table****************
            CustomerTransaction::where('descriptions', 'like', '%sector%Billing%billingID%'.$id.'%')->where('transactionType', 'OUT')->delete();
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
        $table = Billing::where('billMonthID', $id)->get();
        $months = BillMonth::find($id);
        return view('print.bill.details')->with(['table' => $table, 'months' => $months]);

    }



}
