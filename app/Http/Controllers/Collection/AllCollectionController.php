<?php

namespace App\Http\Controllers\Collection;

use App\CustomerTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllCollectionController extends Controller
{
    public function index()
    {
        $table = CustomerTransaction::orderBy('cusTransactionID', 'DESC')
            ->where('descriptions', 'like', '%Billing%Monthly Billing Collection%')
            ->where('transactionType', 'IN')
            ->paginate(300);

        return view('collection.ledger')->with(['table' => $table]);
    }
}
