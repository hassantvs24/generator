<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $table = User::orderBy('id', 'desc')->get();
        return view('users')->with(['table' => $table]);
    }

    public function save(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'userType' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['message' => 'Oh! From Validation error!! Please try again.',  'alert-type' => 'error']);

        }else{
            $table = new User();
            $table->name = $request->name;
            $table->email = $request->email;
            $table->userType = $request->userType;
            $table->password = bcrypt($request->password);
            $table->save();
            return redirect()->back()->with(config('naz.save'));
        }

    }

    public function edit(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'userType' => 'required|string',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->with(['message' => 'Oh! From Validation error!! Please try again.',  'alert-type' => 'error']);

        }else{
            $table =User::find($request->id);
            $table->name = $request->name;
            $table->email = $request->email;
            $table->userType = $request->userType;
            $table->password = bcrypt($request->password);
            $table->save();
            return redirect()->back()->with(config('naz.edit'));
        }

    }


    public function del($id){
        $table = User::find($id);
        $table->delete();
        
        return redirect()->back()->with(config('naz.del'));
    }

}
