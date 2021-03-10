<?php

namespace App\Http\Controllers;
use App\Appointmnet;
use App\Time;
use App\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){

        if(request('date')){
            $doctors = $this->findDoctorsBasedOnDate(request('date'));
            return view('welcome',compact('doctors'));
        }
    $doctors= Appointmnet::where('date',date('Y-m-d'))->get();
   
        return view('welcome' ,compact('doctors') );
    }


    public function show($doctorId,$date){
        $appointment = Appointmnet::where('user_id',$doctorId)->where('date',$date)->first();
        $times = Time::where('appointment_id',$appointment->id)->where('status',0)->get();
        $user = User::where('id',$doctorId)->first();
        $doctor_id = $doctorId;

        return view('appointment',compact('times','date','user','doctor_id'));
    }

    public function findDoctorsBasedOnDate($date)
    {
        $doctors = Appointmnet::where('date',$date)->get();
        return $doctors;

    }
}
