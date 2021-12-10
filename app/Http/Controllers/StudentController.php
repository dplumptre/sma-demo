<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeStudentEmail;
use App\Models\Classroom;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::with('classrooms')->get();
            return response()->json(['data'=>$data],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $this->validate($request, [
            'name' => ['required' ],
            'classroom_id' => ['required' ]
          ]);
         $data =  Student::create([
             'name'         => $request->name,
             'classroom_id' => $request->classroom_id,
          ]);
          $classroom = Classroom::find($data->classroom_id);
          $emaildata = [
                'name'  => $data->name,
                'classroom'   => $classroom->name,
              ];
          // send email
          Mail::to("info@rimotechnology.com")->send(new WelcomeStudentEmail($emaildata));
          return response()->json(['status'=>"successfully created", 'data'=>$data],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $data = Student::with('classrooms')->where('id',$student->id)->first();
        return response()->json(['status'=>"successful", 'data'=>$data],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name' => ['required' ],
            'classroom_id' => ['required' ]
          ]);
          $data = Student::find($student->id);
          $data->name = $request->name;
          $data->classroom_id = $request->classroom_id;
          $data->save();
        return response()->json(['status'=>$data],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['status'=>"successfully deleted"],202);
    }
}
