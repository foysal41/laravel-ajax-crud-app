<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.index');
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'nullable|unique:students,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //এই জায়গা IF Else করব। যদি validate হলে কি করবো আর না হলে কি করব

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()

            ]);
        }else
        {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;

            //photo
            if($request->file('photo'))
            {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move(public_path('upload/students'),$filename);
            }

            $student->photo = $filename;
            $student->save();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
