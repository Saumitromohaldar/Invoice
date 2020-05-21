<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_q = \App\User::orderBy('name','ASC');
        if(!empty($_GET['query'])){
            $search=trim($_GET['query']);
            $users_q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_no', 'like', '%' . $search . '%');
        }

        $users = $users_q->paginate(15);
        $data['users']=$users;
        return view('backend.user.users',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        $user             = new \App\User;        
        $user->email      = $request->email;
        $user->name       = $request->name;
        $user->phone_no   = $request->phone_no;
        $user->role       = 'editor';
        $user->password   =Hash::make($request->password);

        $user->save();
        
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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        $data['user']=$user;
        return view('backend.user.edit-user',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
          //  'password'=>'required'
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
        //$user->role       = 'editor';
       // $user->password   =Hash::make($request->password);

        $user->save();
        
        if($user){
        
            $response = array(
                'status' => 'success',
                'message' => 'User updated successfully.',
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
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'User deleted successfully.');
    }
}
