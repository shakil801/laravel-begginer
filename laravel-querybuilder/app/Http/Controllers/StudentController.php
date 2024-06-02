<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $students = DB::table('students')->get();
        return view('student',['students'=>$students]);
    }
    public function create(){
        return view('student-create');
    }
    public function save(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string',
            'phone'      => 'required|string|max:11',
            'date_of_birth' => 'required|date',
            'gender'     => 'required',
            'address'    => 'required|string|max:500',
        ]);
        DB::table('students')->insert([
            'first_name' =>$validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'email'      => $validatedData['email'],
            'phone'      => $validatedData['phone'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'gender'     => $validatedData['gender'],
            'address'    => $validatedData['address'],
        ]);
        return redirect(route('student.create'))->with('message','Student Created Successfully');
    }
    public function edit(Request $request,$id){
        $id = $request->id;
        $student = DB::table('students')->where('id',$id)->first();
        return view('student-edit',['student'=>$student]);
    }
    public function update(Request $request, $id){
    
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string',
            'phone'      => 'required|string|max:11',
            'date_of_birth' => 'required|date',
            'gender'     => 'required',
            'address'    => 'required|string|max:500',
        ]);
        DB::table('students')->where('id',$id)->update([
            'first_name' =>$validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'email'      => $validatedData['email'],
            'phone'      => $validatedData['phone'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'gender'     => $validatedData['gender'],
            'address'    => $validatedData['address'],
        ]);
        return redirect(route('student'))->with('message','Student Updated Successfully');
    }

    public function delete($id){
        DB::table('students')->where('id',$id)->delete();
        return redirect(route('student'))->with('message','Student Deleted Successfully');
    }
}
