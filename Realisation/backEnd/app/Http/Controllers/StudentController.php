<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return view("Student.index",compact("student"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view("Student.create",compact("id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promotion_id= $request->promotion_id;
        $student = new Student();
        $student->First_name = $request->First_name;
        $student->Last_name = $request->Last_name;
        $student->Email = $request->Email;
        $student->promotion_id = $promotion_id;
        $student->save();
        return redirect('promotion/'.$promotion_id.'/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $TaskCount =Student::find($id)->Tasks;
        // dd($TaskCount);
        return $TaskCount;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $student = Student::find($id);
        return view("Student.edit",compact("student"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $student =Student::find($id);
        $student->First_name = $request->First_name;
        $student->Last_name = $request->Last_name;
        $student->Email = $request->Email;

        $student->save();
        return redirect('promotion/'.$request->promotion_id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student =Student::find($id)->delete();
        return back();
    }
}
