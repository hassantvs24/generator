<?php

namespace App\Http\Controllers;

use App\Cashbook;
use Illuminate\Http\Request;

class CashbookController extends Controller
{
    public function index()
    {

        $table = Cashbook::orderBy('cashbookID', 'desc')->get();
        $amountIn = Cashbook::where('transactionType', 'IN')->sum('amountIN');
        $amountOut = Cashbook::where('transactionType', 'OUT')->sum('amountOut');

        return view('cashbook.cashbook')->with(['table' => $table, 'amountIn' => $amountIn, 'amountOut' => $amountOut]);
    }

    public function cash_in(Request $request){
        if($request->amountIN > 0){
            $table = new Cashbook();
            $table->descriptions = serialize(['sector' =>'Cashbook', 'description' => $request->descriptions]);
            $table->amountIN = $request->amountIN;
            $table->transactionType = 'IN';
            $table->created_at = db_date($request->created_at).' '.date('H:i:s');
            $table->save();

            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }

    public function cash_out(Request $request){
        if($request->amountOut > 0){
            $table = new Cashbook();
            $table->descriptions = serialize(['sector' =>'Cashbook', 'description' => $request->descriptions]);
            $table->amountOut = $request->amountOut;
            $table->transactionType = 'OUT';
            $table->created_at = db_date($request->created_at).' '.date('H:i:s');
            $table->save();

            return redirect()->back()->with(config('naz.save'));
        }else{
            return redirect()->back()->with(config('naz.not_happen'));
        }
    }
}
