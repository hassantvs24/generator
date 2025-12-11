<?php

namespace App\Http\Controllers;

use App\Custom\BdPhone;
use App\Customers;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index()
    {
        $table = Customers::orderBy('customerID', 'DESC')->where('balance', '<', 0)->get();
        return view('sms')->with(['table' => $table]);
    }

    public function sms_send(Request $request){

        try {
            $customerIDs = $request->customerID;

            $table = Customers::whereIn('customerID', $customerIDs)->get();

            $contacts = [];
            foreach ($table as $row){
                $mobile_number = new BdPhone($row->contact);
                if($mobile_number->check()){
                    $contacts[] = $mobile_number->get_number();
                }
            }

            $api_key = 'hSfvTeiXJfrW9ao7O7aH';
            $from = urlencode('THREE STAR');
            $contacts = urlencode(implode("+",$contacts));
            $sms = urlencode($request->sms);
            file_get_contents("https://web.sylsms.xyz/api/smsapi?api_key=".$api_key."&type=text&number=".$contacts."&senderid=".$from."&message=".$sms);

        } catch (\Throwable $e) {
            return redirect()->back()->with(config('naz.error'));
        }

        return redirect()->back()->with(config('naz.all_success'));

    }
}
