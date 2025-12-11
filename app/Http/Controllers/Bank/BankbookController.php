<?php

namespace App\Http\Controllers\Bank;

use App\Bankbook;
use App\Banks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BankbookController extends Controller
{
    public function index()
    {
        $table = Bankbook::orderBy('bankbookID', 'desc')->get();
        $banks = Banks::orderBy('bankID', 'desc')->get();
        $amountIn = Bankbook::where('transactionType', 'IN')->sum('amountIN');
        $amountOut = Bankbook::where('transactionType', 'OUT')->sum('amountOut');
        // $banks_opening = Banks::orderBy('bankID', 'desc')->sum('openingBalance');
        return view('bankbook.bankbook')->with(['table' => $table, 'banks' => $banks, 'amountIn' => $amountIn, 'amountOut' => $amountOut]);
    }

    public function deposit(Request $request){
        if($request->amountIN > 0){

            DB::beginTransaction();
            try {

                $table = new Bankbook();
                $table->bankID = $request->bankID;
                $table->descriptions = $request->descriptions;
                $table->amountIN = $request->amountIN;
                $table->transactionType = 'IN';
                $table->created_at = db_date($request->created_at).' '.date('H:i:s');
                $table->save();

                //*************Bank Table*************
                $bank = Banks::find($request->bankID);
                $old_balance = $bank->balance;
                $new_balance = $old_balance + $request->amountIN;
                $bank->balance = $new_balance;
                $bank->save();
                //*************Bank Table*************


                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }

    public function withdraw(Request $request){
        if($request->amountOut > 0){

            DB::beginTransaction();
            try {

                $table = new Bankbook();
                $table->bankID = $request->bankID;
                $table->descriptions = $request->descriptions;
                $table->amountOut = $request->amountOut;
                $table->transactionType = 'OUT';
                $table->created_at = db_date($request->created_at).' '.date('H:i:s');
                $table->save();

                //*************Bank Table*************
                $bank = Banks::find($request->bankID);
                $old_balance = $bank->balance;
                $new_balance = $old_balance - $request->amountOut;
                $bank->balance = $new_balance;
                $bank->save();
                //*************Bank Table*************

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }


    public function deposit_edi(Request $request){
        if($request->amountIN > 0){

            DB::beginTransaction();
            try {

                $table = Bankbook::find($request->id);

                $old_amount = $table->amountIN;

                $table->bankID = $request->bankID;
                $table->descriptions = $request->descriptions;
                $table->amountIN = $request->amountIN;
                $table->save();

                //*************Bank Table*************
                $bank = Banks::find($request->bankID);
                $old_balance = $bank->balance - $old_amount;
                $new_balance = $old_balance + $request->amountIN;
                $bank->balance = $new_balance;
                $bank->save();
                //*************Bank Table*************

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }

    public function withdraw_edi(Request $request){
        if($request->amountOut > 0){

            DB::beginTransaction();
            try {

                $table = Bankbook::find($request->id);

                $old_amount = $table->amountOut;

                $table->bankID = $request->bankID;
                $table->descriptions = $request->descriptions;
                $table->amountOut = $request->amountOut;
                $table->save();

                //*************Bank Table*************
                $bank = Banks::find($request->bankID);
                $old_balance = $bank->balance + $old_amount;
                $new_balance = $old_balance - $request->amountOut;
                $bank->balance = $new_balance;
                $bank->save();
                //*************Bank Table*************

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }

    public function del($id){
        DB::beginTransaction();
        try {

            $table = Bankbook::find($id);

            $old_amountIN = $table->amountIN;
            $old_amountOUT = $table->amountOut;

            $bankID = $table->bankID;

            //*************Bank Table*************
            $bank = Banks::find($bankID);
            $old_balance = $bank->balance + $old_amountOUT;
            $new_balance = $old_balance - $old_amountIN;
            $bank->balance = $new_balance;
            $bank->save();
            //*************Bank Table*************

            $table->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.del'));
    }



}
