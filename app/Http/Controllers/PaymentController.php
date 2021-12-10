<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $data = Payment::with('classrooms','students')->get();
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
         $data =  Payment::create([
             'status'       => $request->status,
             'classroom_id' => $request->classroom_id,
             'student_id'   => $request->student_id,
          ]);
        return response()->json(['data'=>$data],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {

        $data = Payment::find($payment->id);
        $data->status = $request->status;
        $data->classroom_id = $request->classroom_id;
        $data->student_id = $request->student_id;
        $data->save();
        return response()->json(['status'=>$data],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['status'=>"successfully deleted"],202);
    }




    public function getStudentPayment(Student $student,Classroom $classroom)
    {
       $payment =  Payment::where('student_id',$student->id)->where('classroom_id',$classroom->id)->first();
        if(!$payment){
            return response()->json(['status'=>'payment has not been made'],200);
        }else{
            return response()->json(['status'=>'payment has been made'],200);
        }
    }


}
