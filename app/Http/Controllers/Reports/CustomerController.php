<?php

namespace App\Http\Controllers\Reports;

use App\ComplainBox;
use App\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customers::all();
        $table = ComplainBox::orderBy('complainID', 'DESC')->get();
        return view('reports.customer')->with(['table' => $table, 'customer' => $customer]);
    }

    public function show(Request $request){

        $date_rang = date_time_range($request->dateRang);

        $pre_table = ComplainBox::whereBetween('created_at', [$date_rang[0], $date_rang[1]]);
        if($request->filled('customerID')){
            $pre_table->where('customerID', $request->customerID);
        }
        $table = $pre_table->get();

        return view('print.reports.customer.customer')->with(['table' => $table, 'date_rang' =>  $request->dateRang]);
    }
}
