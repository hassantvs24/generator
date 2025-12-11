<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $table = Employee::all();
        return view('employee.employee')->with(['table' => $table]);
    }


    public function save(Request $request){
        $table = new Employee();
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->nid = $request->nid;
        $table->address = $request->address;
        $table->fatherName = $request->fatherName;
        $table->motherName = $request->motherName;
        $table->dob = $request->dob;
        $table->position = $request->position;
        $table->salary = $request->salary;



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
        $table = Employee::find($request->id);
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->nid = $request->nid;
        $table->address = $request->address;
        $table->fatherName = $request->fatherName;
        $table->motherName = $request->motherName;
        $table->dob = $request->dob;
        $table->position = $request->position;
        $table->salary = $request->salary;

        if($request->hasFile('primaryPhoto')){

            $fileName = ($table->primaryPhoto != '' ? $table->primaryImage : md5(date('d-m-y H:i:s')).'.jpg');

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
        $table = Employee::find($id);
        $table->delete();

        return redirect()->back()->with(config('naz.del'));
    }

}
