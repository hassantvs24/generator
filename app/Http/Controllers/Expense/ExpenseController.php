<?php

namespace App\Http\Controllers\Expense;

use App\Cashbook;
use App\InOutCategory;
use App\InOutTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $category = InOutCategory::where('inOutType', 'OUT')->get();
        $table = InOutTransaction::where('transactionType', 'OUT')->get();
        return view('income_expense.expense')->with(['table' => $table, 'category' => $category]);
    }

    public function save(Request $request){

        if($request->amountOut > 0){
            DB::beginTransaction();
            try {

            $table = new InOutTransaction();
            $table->inoutcatergoryID = $request->inoutcatergoryID;
            $table->descriptions = $request->descriptions;
            $table->amountOut = $request->amountOut;
            $table->transactionType = 'OUT';
            $table->created_at = db_date($request->created_at).' '.date('H:i:s');
            $table->save();

            $transactionID = $table->inouttransactionID;

            //**************Cashbook Table****************
            $cashbook = new Cashbook();
            $cashbook->descriptions = serialize(['sector' =>'Expense', 'description' => $request->descriptions, 'category' =>$request->inoutcatergoryID, 'transactionID' => $transactionID]);
            $cashbook->amountOut = $request->amountOut;
            $cashbook->transactionType = 'OUT';
            $cashbook->created_at = db_date($request->created_at).' '.date('H:i:s');
            $cashbook->save();
            //**************Cashbook Table****************

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

    public function edit(Request $request){
        if($request->amountOut > 0){

            DB::beginTransaction();
            try {

            $table = InOutTransaction::find($request->id);
            $table->inoutcatergoryID = $request->inoutcatergoryID;
            $table->descriptions = $request->descriptions;
            $table->amountOut = $request->amountOut;
            $table->save();

                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Expense%transactionID%'.$request->id.'%')
                    ->where('transactionType', 'OUT')
                    ->update([
                        'amountOut' => $request->amountOut,
                        'descriptions' => serialize(['sector' =>'Expense', 'description' => $request->descriptions, 'category' =>$request->inoutcatergoryID, 'transactionID' => $request->id])
                    ]);
                //**************Cashbook Table****************


                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return redirect()->back()->with(config('naz.edit'));

        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }

    public function del($id){
        DB::beginTransaction();
        try {

        $table = InOutTransaction::find($id);
        $table->delete();

        //**************Cashbook Table****************
        Cashbook::where('descriptions', 'like', '%sector%Expense%transactionID%'.$id.'%')->where('transactionType', 'OUT')->delete();
        //**************Cashbook Table****************

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.del'));
    }

}
