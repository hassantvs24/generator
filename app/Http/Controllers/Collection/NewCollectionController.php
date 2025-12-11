<?php

namespace App\Http\Controllers\Collection;

use App\Cashbook;
use App\Customers;
use App\CustomerTransaction;
use App\Custom\BdPhone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewCollectionController extends Controller
{
    public function index()
    {
        $table = Customers::where('balance', '<', 0)->get();
        return view('collection.collection')->with(['table' => $table]);
    }

    public function payment_details($id){

        $table = Customers::find($id);
        return view('collection.collection_payment_details')->with(['table' => $table]);
    }

	public function payment(Request $request){

			$months  = ($request->filled('month') ? implode(", ", $request->month) : '');

			DB::beginTransaction();
			try {
				if($request->amount > 0){

					$table = Customers::find($request->customerID);
					$contact = $table->contact;
					$old_balance = $table->balance;
					$new_balance = $old_balance + $request->amount;
					$table->balance = $new_balance;
					$table->save();

					$due = 0;
					$mbalance = $table->balance;
					if($mbalance < 0){
						$due = abs($mbalance);
					}

					$service_count = $table->service()->where('status', 'Active')->count();

				//**************Transaction Table****************
					$transaction1 = new CustomerTransaction();
					$transaction1->customerID = $request->customerID;
					$transaction1->amountIN = $request->amount;
					$transaction1->transactionType = 'IN';
					$transaction1->descriptions = serialize(['sector' =>'Billing', 'transactionType' => 'Monthly Billing Collection', 'monthName' => $months]);
                    $transaction1->created_at = db_date($request->customDate).' '.date('H:i:s');
					$transaction1->save();
					$cusTransactionID = $transaction1->cusTransactionID;
				//**************Transaction Table****************


				//**************Cashbook Table****************
					$cashbook = new Cashbook();
					$cashbook->descriptions = serialize(['sector' =>'Billing', 'description' => 'Bill Collection', 'customer' => $request->customerID, 'transactionID' => $cusTransactionID]);
					$cashbook->amountIN = $request->amount;
					$cashbook->transactionType = 'IN';
                    $cashbook->created_at = db_date($request->customDate).' '.date('H:i:s');
					$cashbook->save();
				//**************Cashbook Table****************

				}
				
                //#############SMS#############
                if (isset($request->sendSms)) {
                   $mobile_number = new BdPhone($contact);
                    if($mobile_number->check()){
                        $api_key = 'hSfvTeiXJfrW9ao7O7aH';
                        $from = urlencode('THREE STAR');
                        $contacts = $mobile_number->get_number();
                        $sms = urlencode("Dear ".$table->name."\nYour Payment of tk. ".$request->amount." is received.\nThank you from THREE STAR");
                    
                        file_get_contents("https://web.sylsms.xyz/api/smsapi?api_key=".$api_key."&type=text&number=".$contacts."&senderid=".$from."&message=".$sms);
                    }
                }
                //###########SMS#############
                

				DB::commit();
			} catch (\Throwable $e) {
				DB::rollback();
				throw $e;
			}

			return redirect()->action(
				'SlipController@index', ['customerID' => $request->customerID,
                'customerName' => $table->name,
                'address' => $table->address,
                'package' => $service_count,
                'slipNo' => $cusTransactionID,
                'due' => $due,
                'monthName' => $months,
                'amount' => $request->amount,
                'customDate' => $request->customDate.' '.date('h:i a'),
                'backUrl' => $request->backUrl
           ]);

		}


    public function payment_edit(Request $request){
        DB::beginTransaction();
        try {

            if($request->amount == 0){
                $table = CustomerTransaction::find($request->id);
                $in_amount = $table->amountIN;
                $customerID = $table->customerID;


                $customer = Customers::find($customerID);
                $old_balance = $customer->balance;
                $new_balance = $old_balance - $in_amount;
                $customer->balance = $new_balance + $request->amount;
                $customer->save();

                $table->delete();

                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Billing%description%Bill Collection%customer%'.$customerID.'%transactionID%'.$request->id.'%')->where('transactionType', 'IN')->delete();
                //**************Cashbook Table****************

            }else{
                $table = CustomerTransaction::find($request->id);
                $in_amount = $table->amountIN;
                $customerID = $table->customerID;
                $table->amountIN = $request->amount;



                $customer = Customers::find($customerID);
                $old_balance = $customer->balance;
                $new_balance = $old_balance - $in_amount;
                $customer->balance = $new_balance + $request->amount;
                $customer->save();

                $table->save();

                //**************Cashbook Table****************
                Cashbook::where('descriptions', 'like', '%sector%Billing%description%Bill Collection%customer%'.$customerID.'%transactionID%'.$request->id.'%')
                    ->where('transactionType', 'IN')
                    ->update([
                        'amountIN' => $request->amount
                    ]);
                //**************Cashbook Table****************


            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }


    public function payment_del($id){
        DB::beginTransaction();
        try {

            $table = CustomerTransaction::find($id);
            $in_amount = $table->amountIN;
            $customerID = $table->customerID;


            //**************Customer Table****************
            if($in_amount > 0){
                $customer = Customers::find($customerID);
                $old_balance = $customer->balance;
                $new_balance = $old_balance - $in_amount;
                $customer->balance = $new_balance;
                $customer->save();
            }

            //**************Customer Table****************

            //**************Cashbook Table****************
            Cashbook::where('descriptions', 'like', '%sector%Billing%description%Bill Collection%customer%'.$customerID.'%transactionID%'.$id.'%')->where('transactionType', 'IN')->delete();
            //**************Cashbook Table****************
            
            $table->delete();

            


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }


}
