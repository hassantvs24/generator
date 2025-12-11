<?php

namespace App\Http\Controllers;

use App\Area;
use App\CustomerCategory;
use App\Customers;
use App\CustomerTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    public function index()
    {
        $date_rang = single_date_range(date('Y-m-d'));

        $table = Customers::where('balance', '<', 0)->get();

        $transaction_amount = CustomerTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])
            ->where('transactionType', 'IN')->where('userID', Auth::user()->id)->sum('amountIN');

        $transaction_count = CustomerTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])
            ->where('transactionType', 'IN')->where('userID', Auth::user()->id)->count();

        $area = Area::all();
        $category = CustomerCategory::all();

        return view('collector.collector')->with(['table' => $table, 'amount' => $transaction_amount, 'counts' => $transaction_count, 'area' => $area, 'category' => $category]);
    }

    public function payment_details($id){

        $table = Customers::find($id);
        return view('collector.payment_details')->with(['table' => $table]);
    }
}
