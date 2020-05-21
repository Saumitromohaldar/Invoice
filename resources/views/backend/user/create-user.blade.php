@extends('backend.layouts.app')
@section('title', 'Add Company')
@section('content')
    <section class="content-header">
        <h1>
            Add User
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">Add User</h3>
            </div>

            <form method="POST" id="save-user" action="{{route('users.store')}}">
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

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="company_name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                            <span class="help-block display-none error_name error_message"></span>
                            @if($errors->has('name'))
                                <span class="help-block">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label for="company_name">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            <span class="help-block display-none error_email error_message"></span>
                            @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone_no">Phone</label>
                            <input type="text" class="form-control" name="phone_no" placeholder="Phone" value="{{ old('phone_no') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_no">Password</label>
                            <input type="text" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                            <span class="help-block display-none error_password error_message"></span>
                        </div>

                    </div>
                    

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Add User">
                </div>
            </form>

        </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
