<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $students = Student::with('school')->orderBy('id','desc')->paginate(10);
        return view('student.index', compact('students'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $school = School::orderBy('id','desc')->get();

        return view('student.create', compact('school'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',


        ]);

        $school = Student::create([
            'first_name' => $request -> firstname,
            'last_name' => $request -> lastname,

            'email' => ($request -> email != null) ? $request -> email : '',
            'phone' => $request->phone,
            'school_id' => $request->school


        ]);


        return redirect()->route('student.index')->with('success','Student has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Student $student)
    {
        return view('student.show',compact('student'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(Student $student)
    {
        $school = School::orderBy('id','desc')->get();

        return view('student.edit',compact('student','school'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'firstname' => 'required',
        ]);

        $update_field = Student::where('id' , $student->id)->update([
            'first_name' => $request -> firstname,
            'last_name' => $request -> lastname,
            'email' => ($request -> email != null) ? $request -> email : '',
            'phone' => $request->phone,
            'school_id' => $request->school

            ]);


        return redirect()->route('student.index')->with('success','Student Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success','student has been deleted successfully');
    }
}
