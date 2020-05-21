@extends('backend.layouts.app')
@section('title', 'Add Company')
@section('content')
    <section class="content-header">
        <h1>
            Edit Profile
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-6 ">
            <div class="box box-info">

                <div class="box-header with-border">
                    <h3 class="box-title">Edit Profile</h3>
                </div>

                <form method="POST" id="update-user" action="{{route('profile.update',$user->id)}}">
                    @csrf                    
                    @method('PUT')
                    <div class="box-body">

                        @if(session()->has('message'))
                            <div class="callout callout-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif                   

                        <div class="col-md-12">  
                            
                            @if(session()->has('message'))
                                <div class="callout callout-info">
                                    {{ session()->get('message') }}
                                </div>
                            @endif 

                            <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                                <label for="company_name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                                <span class="help-block display-none error_name error_message"></span>
                                @if($errors->has('name'))
                                    <span class="help-block">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                                <label for="company_name">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                                <span class="help-block display-none error_email error_message"></span>
                                @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone_no">Phone</label>
                                <input type="text" class="form-control" name="phone_no" placeholder="Phone" value="{{ $user->phone_no }}">
                            </div>                           

                        </div>                        

                    </div>
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Update User">
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-6 ">
            <div class="box box-info">

                <div class="box-header with-border">
                    <h3 class="box-title">Update Password</h3>
                </div>

                <form method="POST" id="update-password" action="{{route('password.update',$user->id)}}">
                    @csrf                    
                    <div class="box-body">

                        @if(session()->has('message'))
                            <div class="callout callout-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif                   

                        <div class="col-md-12">  
                            
                            @if(session()->has('message'))
                                <div class="callout callout-info">
                                    {{ session()->get('message') }}
                                </div>
                            @endif                           

                            <div class="form-group">
                                <label for="phone_no">Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Password" value="">
                                <span class="help-block display-none error_current_password error_message"></span>
                            </div> 

                            <div class="form-group">
                                <label for="phone_no">New Password</label>
                                <input type="password" class="form-control" name="new_password" placeholder="New Password" value="">
                                <span class="help-block display-none error_new_password error_message"></span>
                            </div> 

                            <div class="form-group">
                                <label for="phone_no">New Confirm Password</label>
                                <input type="password" class="form-control" name="new_confirm_password" placeholder="New Confirm Password" value="">
                                <span class="help-block display-none error_new_confirm_password error_message"></span>
                            </div>

                        </div>
                        

                    </div>
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
