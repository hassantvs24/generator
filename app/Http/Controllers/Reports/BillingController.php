<?php

namespace App\Http\Controllers\Reports;

use App\Area;
use App\Customers;
use App\CustomerTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    public function index()
    {
        $customer = Customers::all();
        $area = Area::all();
        return view('reports.billing')->with(['customer' => $customer, 'area' => $area]);
    }

    public function customer_ledger(Request $request){
        $customer = Customers::find($request->customerID);

        $date_rang = date_time_range($request->dateRang);
        $table = CustomerTransaction::where('customerID', $request->customerID)->whereBetween('created_at', [$date_rang[0], $date_rang[1]])->get();


        return view('print.reports.billing.customer')->with(['table' => $table, 'date_rang' =>  $request->dateRang,  'customer' => $customer]);
    }

    public function all_customer_ledger(Request $request){

        $date_rang = date_time_range($request->dateRang);

        $table = CustomerTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])->get();

        return view('print.reports.billing.all_ledger')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }

    public function due(Request $request){

        $area = Area::find($request->areaID);

        $pre_table = Customers::where('balance', '<', 0);
        if($request->filled('areaID')){
            $pre_table->where('areaID', $request->areaID);
        }
        $table = $pre_table->get();

        return view('print.reports.billing.due')->with(['table' => $table, 'area' =>  $area]);
    }

    public function collection(Request $request){
        $date_rang = date_time_range($request->dateRang);

        $table = CustomerTransaction::whereBetween('created_at', [$date_rang[0], $date_rang[1]])
            ->where('descriptions', 'like', '%Billing%Monthly Billing Collection%')
            ->where('transactionType', 'IN')
            ->get();
        return view('print.reports.billing.collection')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }

}
