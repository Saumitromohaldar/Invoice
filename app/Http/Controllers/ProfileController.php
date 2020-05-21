<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Response;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        $data['user']=$user;
        return view('backend.user.edit-profile',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $user=Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
          
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

       // $user             = new \App\User;        
        $user->email      = $request->email;
        $user->name       = $request->name;
        $user->phone_no   = $request->phone_no;
        
       // $user->password   =Hash::make($request->password);

        $user->save();
        
        if($user){
        
            $response = array(
                'status' => 'success',
                'message' => 'Updated successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {   
        

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required','different:current_password'],

            'new_confirm_password' => ['same:new_password'],
          
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }


        $user=User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

   
        
        if($user){
        
            $response = array(
                'status' => 'success',
                'message' => 'Company added successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }


}
