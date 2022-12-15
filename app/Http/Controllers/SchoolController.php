<?php

namespace App\Http\Controllers;
use App\Models\School;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mail;
use Exception;
class SchoolController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $schools = School::orderBy('id','desc')->paginate(10);
        return view('school.index', compact('schools'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('school.create');
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
            'name' => 'required',
            'email' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=100,max_height=100',


        ]);

        $school = School::create([
            'name' => $request -> name,
            'email' => ($request -> email != null) ? $request -> email : '',
            'website' => $request->website,

        ]);

        if($request->hasFile('logo') && $school) {
            $fileName_image = Str::random(40).'.'.$request->file('logo')->getClientOriginalExtension();
            $path_image = Storage::disk('public')->putFileAs('school-logo',$request->file('logo'),$fileName_image);
            School::where('id',$school->id)->update(['logo'=> $fileName_image]);
        }
        $data=[];
        $email=$request -> email;
        try{
        Mail::send(['text'=>'mail'], $data, function($message) use($email){
            $message->to($email, 'Student Created')->subject
               ('Student Created mail');
            $message->from('sneham152@gmail.com','sneha MS');
         });
        }catch(Exception $e)
        {


        }
          return redirect()->route('school.index')->with('success','School has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(School $school)
    {
        return view('school.show',compact('school'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(School $school)
    {
        return view('school.edit',compact('school'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=100,max_height=100',

        ]);

        $update_field = School::where('id' , $school->id)->update([
            'name' => $request -> name,
            'email' => ($request -> email != null) ? $request -> email : '',
            'website' => $request->website,
            ]);
            if($request->hasFile('logo')) {
                $fileName_image = Str::random(40).'.'.$request->file('logo')->getClientOriginalExtension();
                $path_image = Storage::disk('public')->putFileAs('school-logo',$request->file('logo'),$fileName_image);
                School::where('id',$school->id)->update(['logo'=> $fileName_image]);
            }

        return redirect()->route('school.index')->with('success','School Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('school.index')->with('success','school has been deleted successfully');
    }
}
