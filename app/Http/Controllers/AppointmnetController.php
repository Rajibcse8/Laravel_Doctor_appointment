<?php

namespace App\Http\Controllers;

use App\Appointmnet;
use Illuminate\Http\Request;
use App\Time;

class AppointmnetController extends Controller
{
  
    
    public function index()
    {
       
        $myappointments = Appointmnet::latest()->where('user_id',auth()->user()->id)->get();
        
        return view('admin.appointment.index',compact('myappointments'));
    }

    
    
    public function create()
    {
       
        return view('admin.appointment.create');
        
    }

  
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'date'=>'required|unique:appointmnets,date,NULL,id,user_id,'.\Auth::id(),
            'time'=>'required'
        ]);
        $appointment = Appointmnet::create([
            'user_id'=> auth()->user()->id,
            'date' => $request->date
        ]);
        foreach($request->time as $time){
            Time::create([
                'appointment_id'=> $appointment->id,
                'time'=> $time,
                //'stauts'=>0
            ]);
        }
        return redirect()->back()->with('message','Appointment created for'. $request->date);
       
        
    }

  
    
    public function show(Appointmnet $appointmnet)
    {
       
        
    }

    
    
    public function edit(Appointmnet $appointmnet)
    {
        
        
    }

    
    
    public function update(Request $request, Appointmnet $appointmnet)
    {
        
        
    }

   
    
    public function destroy(Appointmnet $appointmnet)
    {
       
        
    }

    public function check(Request $request){

        $date = $request->date;
        $appointment= Appointmnet::where('date',$date)->where('user_id',auth()->user()->id)->first();
        if(!$appointment){
            return redirect()->to('/appointment')->with('errmessage','Appointment time not available for this date');
        }
        $appointmentId = $appointment->id;
        $times = Time::where('appointment_id',$appointmentId)->get();

       
        return view('admin.appointment.index',compact('times','appointmentId','date'));
    }

    public function updateTime(Request $request){
        $appointmentId = $request->appoinmentId;
        $appointment = Time::where('appointment_id',$appointmentId)->delete();
        foreach($request->time as $time){
            Time::create([
                'appointment_id'=>$appointmentId,
                'time'=>$time,
                'status'=>0
            ]);
        }
        return redirect()->route('appointment.index')->with('message','Appointment time updated!!');
    }


}
