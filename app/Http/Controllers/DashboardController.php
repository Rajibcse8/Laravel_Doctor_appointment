<?php

namespace App\Http\Controllers;
use Auth;
use App\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
     
    if(Auth::user()->role->name=="patient"){
        return view('home');
    }
    if(Auth::user()->role->name=="admin" || Auth::user()->role->name=="doctor"){
        return view('dashboard');
    }
   }
}
