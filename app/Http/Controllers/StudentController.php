<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['students'] = Student::all();
        return view('students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd('this is store methos');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|unique:students,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //এই জায়গা IF Else করব। যদি validate হলে কি করবো আর না হলে কি করব

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()

            ]);
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;

            //photo
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('upload/students'), $filename);
                $student->photo = $filename;
            }


            $student->save();

            return redirect()->route('students.index');

            return response()->json([
                'status' => 200,
                'message' => 'Data Inserted Successfully'

            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd('this  is updpate ');


        //dd('this is store methos');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|unique:students,email,' .$id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //এই জায়গা IF Else করব। যদি validate হলে কি করবো আর না হলে কি করব

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()

            ]);
        } else {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;

            //photo
            if ($request->file('photo')) {
                $path = 'upload/students/' . $student->photo;

                //dd($path);
                if (File::exists($path)) {
                    File::delete($path);
                }

                // নতুন ফাইল প্রসেস করা
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('upload/students'), $filename);

                // নতুন ফাইলের নাম সংরক্ষণ
                $student->photo = $filename;
            } else {
                // যদি ফাইল না থাকে, পুরোনো ফাইলের নামই রাখা
                $filename = $student->photo;
            }


            // স্টুডেন্টের অন্যান্য ডেটা আপডেট করা
            $student->save();

            return redirect()->route('students.index');

            // সফলভাবে রেসপন্স পাঠানো
            return response()->json([
                'status' => 200,
                'message' => 'Data Updated Successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd('this is destroy');

        $student = Student::find($id);
       if($student)
       {
        $student->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ]);



       }else{
        return response()->json([
            'status' => 404,
            'message' => 'Data Not Found'

        ]);
       }

       return redirect()->route('students.index');
    }
}
