<?php

namespace App\Http\Controllers\Salary;

use App\EmployeeTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgerController extends Controller
{
    public function index()
    {
        $table = EmployeeTransaction::orderBy('empTransactionID', 'DESC')
            ->where('descriptions', 'like', '%Salary%Monthly Salary Payment%')
            ->where('transactionType', 'OUT')
            ->get();

        return view('salary.ledger')->with(['table' => $table]);
    }
}
