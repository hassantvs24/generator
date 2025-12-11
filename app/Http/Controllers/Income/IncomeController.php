<?php

namespace App\Http\Controllers\Income;

use App\Cashbook;
use App\InOutCategory;
use App\InOutTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{

    public function index()
    {
        $category = InOutCategory::where('inOutType', 'IN')->get();
        $table = InOutTransaction::where('transactionType', 'IN')->get();
        return view('income_expense.income')->with(['table' => $table, 'category' => $category]);
    }

    public function save(Request $request){
        if($request->amountIN > 0){
            DB::beginTransaction();
            try {

            $table = new InOutTransaction();
            $table->inoutcatergoryID = $request->inoutcatergoryID;
            $table->descriptions = $request->descriptions;
            $table->amountIN = $request->amountIN;
            $table->transactionType = 'IN';
            $table->created_at = db_date($request->created_at).' '.date('H:i:s');
            $table->save();

            $transactionID = $table->inouttransactionID;

            //**************Cashbook Table****************
            $cashbook = new Cashbook();
            $cashbook->descriptions = serialize(['sector' =>'Income', 'description' => $request->descriptions, 'category' =>$request->inoutcatergoryID, 'transactionID' => $transactionID]);
            $cashbook->amountIN = $request->amountIN;
            $cashbook->transactionType = 'IN';
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
        if($request->amountIN > 0){
            DB::beginTransaction();
            try {

            $table = InOutTransaction::find($request->id);
            $table->inoutcatergoryID = $request->inoutcatergoryID;
            $table->descriptions = $request->descriptions;
            $table->amountIN = $request->amountIN;
            $table->save();


                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Income%transactionID%'.$request->id.'%')
                    ->where('transactionType', 'IN')
                    ->update([
                        'amountIN' => $request->amountIN,
                        'descriptions' => serialize(['sector' =>'Income', 'description' => $request->descriptions, 'category' =>$request->inoutcatergoryID, 'transactionID' => $request->id])
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
        Cashbook::where('descriptions', 'like', '%sector%Income%transactionID%'.$id.'%')->where('transactionType', 'IN')->delete();
        //**************Cashbook Table****************


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.del'));
    }

}
