<?php

namespace App\Http\Controllers\Customer;

use App\Area;
use App\ComplainBox;
use App\CustomerCategory;
use App\Customers;
use App\CustomerTransaction;
use App\Package;
use App\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        $table = Customers::all();
        $area = Area::all();
        $category = CustomerCategory::all();
        return view('customer.customer')->with(['table' => $table, 'area' => $area, 'category' => $category]);
    }

    public function save(Request $request){
        $table = new Customers();
        $table->areaID = $request->areaID;
        $table->customerCatID = $request->customerCatID;
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->nid = $request->nid;
        $table->address = $request->address;
        $table->fatherName = $request->fatherName;
        $table->motherName = $request->motherName;
        $table->dob = $request->dob;


        if($request->hasFile('primaryPhoto')){

            $fileName = md5(date('d-m-y H:i:s')).'.jpg';

            $thumbs_sm = Image::make($request->file('primaryPhoto'));
            $thumbs_sm->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm->resizeCanvas(300, 300, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm = $thumbs_sm->stream('jpg');

            Storage::disk('general')->put($fileName, $imageStream_sm->__toString());

            $table->primaryPhoto = $fileName;
        }

        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function edit(Request $request){
        $table = Customers::find($request->id);
        $table->areaID = $request->areaID;
        $table->customerCatID = $request->customerCatID;
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->nid = $request->nid;
        $table->address = $request->address;
        $table->fatherName = $request->fatherName;
        $table->motherName = $request->motherName;
        $table->dob = $request->dob;


        if($request->hasFile('primaryPhoto')){

            $fileName = md5(date('d-m-y H:i:s')).'.jpg'; //($table->primaryPhoto != '' ? $table->primaryImage : md5(date('d-m-y H:i:s')).'.jpg');

            $thumbs_sm = Image::make($request->file('primaryPhoto'));
            $thumbs_sm->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm->resizeCanvas(300, 300, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm = $thumbs_sm->stream('jpg');

            Storage::disk('general')->put($fileName, $imageStream_sm->__toString());

            $table->primaryPhoto = $fileName;
        }

        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }


    public function del($id){
        $table = Customers::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }


    public function details($id){
        $table = Customers::find($id);
        $package = Package::all();
        return view('customer.details')->with(['table' => $table, 'package' => $package]);
    }

    public function service_save(Request $request){
        $table = new Services();
        $table->customerID = $request->customerID;
        $table->packageID = $request->packageID;
        $table->billingAmount = $request->billingAmount;
        $table->light = $request->light;
        $table->fan = $request->fan;
        $table->printer = $request->printer;
        $table->computer = $request->computer;
        $table->stabilizer = $request->stabilizer;
        $table->other = $request->other;
        $table->save();

        return redirect()->back()->with(config('naz.save'));
    }

    public function service_edi(Request $request){
        $table = Services::find($request->id);
        $table->customerID = $request->customerID;
        $table->packageID = $request->packageID;
        $table->billingAmount = $request->billingAmount;
        $table->light = $request->light;
        $table->fan = $request->fan;
        $table->printer = $request->printer;
        $table->computer = $request->computer;
        $table->stabilizer = $request->stabilizer;
        $table->other = $request->other;
        $table->save();

        return redirect()->back()->with(config('naz.edit'));
    }

    public function service_activate($id){
        $table = Services::find($id);
        $status = $table->status;
        if($status == 'Active'){
            $table->status = 'Dative';
        }else{
            $table->status = 'Active';
        }
        $table->save();
        return redirect()->back()->with(config('naz.all_success'));
    }

    public function service_del($id){
        $table = Services::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }


    public function balance_adjust(Request $request){
        DB::beginTransaction();
        try {

        $table = Customers::find($request->customerID);
        $old_balance = $table->balance;
        $new_balance = $old_balance + $request->add_balance - $request->due_balance;
        $table->balance = $new_balance;
        $table->save();

        //**************Transaction Table****************
            if($request->add_balance > 0){
                $transaction1 = new CustomerTransaction();
                $transaction1->customerID = $request->customerID;
                $transaction1->amountIN = $request->add_balance;
                $transaction1->transactionType = 'IN';
                $transaction1->descriptions = serialize(['sector' =>'General', 'transactionType' => $request->balanceType]);
                $transaction1->save();
            }

            if($request->due_balance > 0){
                $transaction2 = new CustomerTransaction();
                $transaction2->customerID = $request->customerID;
                $transaction2->amountOut = $request->due_balance;
                $transaction2->transactionType = 'OUT';
                $transaction2->descriptions = serialize(['sector' =>'General', 'transactionType' => $request->balanceType]);
                $transaction2->save();
            }
        //**************Transaction Table****************

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }


    public function balance_edi_adjust(Request $request){
        DB::beginTransaction();
        try {

            if ($request->transactionType == 'IN'){

                if($request->add_balance == 0){
                    $table = CustomerTransaction::find($request->id);
                    $in_amount = $table->amountIN;
                    $customerID = $table->customerID;


                    $customer1 = Customers::find($customerID);
                    $old_balance1 = $customer1->balance;
                    $new_balance1 = $old_balance1 - $in_amount;
                    $customer1->balance = $new_balance1 + $request->add_balance;
                    $customer1->save();

                    $table->delete();
                }else{
                    $table = CustomerTransaction::find($request->id);
                    $in_amount = $table->amountIN;
                    $customerID = $table->customerID;
                    $table->amountIN = $request->add_balance;
                    $table->descriptions = serialize(['sector' =>'General', 'transactionType' => $request->balanceType]);


                    $customer1 = Customers::find($customerID);
                    $old_balance1 = $customer1->balance;
                    $new_balance1 = $old_balance1 - $in_amount;
                    $customer1->balance = $new_balance1 + $request->add_balance;
                    $customer1->save();

                    $table->save();
                }


            }else{

                if($request->due_balance == 0){

                    $table = CustomerTransaction::find($request->id);
                    $out_amount = $table->amountOut;
                    $customerID = $table->customerID;


                    $customer2 = Customers::find($customerID);
                    $old_balance2 = $customer2->balance;
                    $new_balance2 = $old_balance2 + $out_amount;
                    $customer2->balance = $new_balance2 - $request->due_balance;
                    $customer2->save();

                    $table->delete();
                    
                }else{
                    $table = CustomerTransaction::find($request->id);
                    $out_amount = $table->amountOut;
                    $customerID = $table->customerID;
                    $table->amountOut = $request->due_balance;
                    $table->descriptions = serialize(['sector' =>'General', 'transactionType' => $request->balanceType]);


                    $customer2 = Customers::find($customerID);
                    $old_balance2 = $customer2->balance;
                    $new_balance2 = $old_balance2 + $out_amount;
                    $customer2->balance = $new_balance2 - $request->due_balance;
                    $customer2->save();

                    $table->save();
                }

            }


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }



    public function balance_del($id){
        DB::beginTransaction();
        try {

            $table = CustomerTransaction::find($id);
            $in_amount = $table->amountIN;
            $out_amount = $table->amountOut;
            $customerID = $table->customerID;


            //**************Customer Table****************
            if($in_amount > 0){
                $customer1 = Customers::find($customerID);
                $old_balance1 = $customer1->balance;
                $new_balance1 = $old_balance1 - $in_amount;
                $customer1->balance = $new_balance1;
                $customer1->save();
            }

            if($out_amount > 0){
                $customer2 = Customers::find($customerID);
                $old_balance2 = $customer2->balance;
                $new_balance2 = $old_balance2 + $out_amount;
                $customer2->balance = $new_balance2;
                $customer2->save();
            }
            //**************Customer Table****************
            $table->delete();


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with(config('naz.all_success'));
    }

    public function complain_list(){
        $table = ComplainBox::orderBy('complainID','DESC')->get();
        return view('customer.complain')->with(['table' => $table]);
    }

    public function complain(Request $request){
        $table = new ComplainBox();
        $table->customerID = $request->customerID;
        $table->descriptions = $request->descriptions;
        $table->save();
        return redirect()->back()->with(config('naz.all_success'));
    }

    public function complain_status($id){
        $table = ComplainBox::find($id);

        $status = $table->status;
        if($status == 'Incomplete'){
            $table->status = 'Complete';
        }else{
            $table->status = 'Incomplete';
        }

        $table->save();
        return redirect()->back()->with(config('naz.all_success'));
    }

    public function complain_del($id){
        $table = ComplainBox::find($id);
        $table->delete();
        return redirect()->back()->with(config('naz.all_success'));
    }

}
