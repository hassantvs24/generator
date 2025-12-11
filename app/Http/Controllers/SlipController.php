<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlipController extends Controller
{
    public function index(Request $request)
    {

        return view('print.slip')->with([
            'customerID' => $request->customerID,
            'customerName' => $request->customerName,
            'address' => $request->address,
            'package' => $request->package,
            'slipNo' => $request->slipNo,
            'due' => $request->due,
            'monthName' => $request->monthName,
            'amount' => $request->amount,
            'customDate' => $request->customDate,
            'backUrl' => $request->backUrl
        ]);
    }
}
