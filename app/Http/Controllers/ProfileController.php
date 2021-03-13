<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
  
    
    public function index()
    {
        return view('profile.index');
    }

    
    public function create()
    {
      
    }

    public function store(Request $request)
    {
        $this->validate($request,[
    		'name'=>'required',
    		'gender'=>'required'
    	]);
    	User::where('id',auth()->user()->id)
    		->update($request->except('_token'));
    	return redirect()->back()->with('message','profile updated');
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
        
    }

    public function profilePic(Request $request)
    {
    	$this->validate($request,['file'=>'required|image|mimes:jpeg,jpg,png']);
    	if($request->hasFile('file')){
    		$image = $request->file('file');
    		$name = time().'.'.$image->getClientOriginalExtension();
    		$destination = public_path('/profile');
    		$image->move($destination,$name);
    		
    		$user = User::where('id',auth()->user()->id)->update(['image'=>$name]);
    		
    		return redirect()->back()->with('message','profile updated');


    	}
    }
}
