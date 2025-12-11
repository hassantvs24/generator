<?php

namespace App\Http\Controllers\Collection;

use App\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DueCollectionController extends Controller
{
    public function index()
    {
        $table = Customers::all();
        return view('collection.detail_collection')->with(['table' => $table]);
    }

    public function payment_details($id){

        $table = Customers::find($id);
        return view('collection.payment_details')->with(['table' => $table]);
    }

}
