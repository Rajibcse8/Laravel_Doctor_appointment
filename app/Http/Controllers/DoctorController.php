<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use HasAvatar;

class DoctorController extends Controller
{
  
    
    public function index()
    {
        $users  = User::where('role_id','!=',3)->get();
        return view('admin.doctor.index',compact('users'));
    }

    
    public function create()
    {
       return view('admin.doctor.create');
    }

    
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $name = (new User)->userAvatar($request);

        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('message','Doctor added successfully');


    }

    
    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    
    public function update(Request $request, $id)
    {
        //
    }

  
    
    public function destroy($id)
    {
        //
    }
    

    public function validateStore($request){
        return  $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6|max:25',
            'gender'=>'required',
            'education'=>'required',
            'address'=>'required',
            'department'=>'required',
            'phone_number'=>'required|numeric',
            'image'=>'required|mimes:jpeg,jpg,png',
            'role_id'=>'required',
            'description'=>'required',

       ]);
    }


}
