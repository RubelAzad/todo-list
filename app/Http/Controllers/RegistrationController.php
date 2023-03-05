<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function register(){
        return view('auth.register');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @return \App\Models\User
     * @return \Illuminate\Http\Response
     */
    protected function create(Request $request)
    {
        
        $validators=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',           
        ]);
        if($validators->fails()){
            return redirect()->route('auth.register')->withErrors($validators)->withInput();
        }else{
            $user=new User();
            $user->name=$request->name;
            $user->username=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            return redirect()->route('auth.login')->with('message','User created successfully !');
        }

    }



}
