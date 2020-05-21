@extends('backend.layouts.app')
@section('title', 'Add Company')
@section('content')
    <section class="content-header">
        <h1>
            Add Company
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Company</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">Add Company</h3>
            </div>

            <form method="POST" id="save-company" action="{{route('save-company')}}">
                @csrf
                <div class="box-body">

                    @if(session()->has('message'))
                        <div class="callout callout-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @php
                        $countryList=Config::get('constants.countries');
                        $districtList=Config::get('constants.districts');
                        
                    @endphp
                    <div class="col-md-6">  
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Company Name" value="{{ old('name') }}">
                            <span class="help-block display-none error_name error_message"></span>
                            @if($errors->has('name'))
                                <span class="help-block">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group {{ $errors->has('file_number') ? 'has-error' :'' }}">
                            <label for="file_number">File Number</label>
                            <input type="text" class="form-control" name="file_number" placeholder="File Number" value="{{ old('file_number') }}">
                            <span class="help-block display-none error_file_number error_message"></span>
                            @if($errors->has('file_number'))
                                <span class="help-block">{{$errors->first('file_number')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">   
                        <label>Company Address</label>
                        <hr>
                        <div class="form-group ">
                            <label for="company_name">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}">
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
                            {!! Form::select('country', $countryList, 'Bangladesh', ['class' => 'form-control select2','placeholder'=>'Select Country']) !!}
                        </div>

                        <div class="form-group ">
                            {{-- <label for="district">District</label> --}}
                            {!! Form::label('district', 'District', ['class' => 'control-label']) !!}
                            {!! Form::select('district', $districtList, old('district'),['class' => 'form-control select2','placeholder'=>'Select District']) !!}
                            {{-- <input type="text" class="form-control" name="district" placeholder="District" value="{{ old('district') }}"> --}}
                        </div>

                        {{-- <div class="form-group ">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">
                        </div> --}}

                        <div class="form-group ">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" name="postcode" placeholder="Postcode" value="{{ old('postcode') }}">
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
                    </div>
                    <div class="col-md-6">

                        <label>Company Registration Information</label>
                        <hr>

                        <div class="form-group">
                            <label for="reg_no_online">Online Reg No</label>
                            <input type="text" class="form-control" name="reg_no_online" placeholder="Online Reg No" value="{{ old('reg_no_online') }}">
                        </div>

                        <div class="form-group">
                            <label for="reg_no_manual">Manual Reg No</label>
                            <input type="text" class="form-control" name="reg_no_manual" placeholder="Manual Reg No" value="{{ old('reg_no_manual') }}">
                        </div>

                        <div class="form-group">
                            <label for="company_name">Reg Date</label>
                            <input type="text" class="form-control date_field" name="reg_date" id="reg_date" placeholder="Registration Date" value="{{date('d-m-Y')}}">
                        </div>

                        <div class="form-group">
                            <label for="company_name">User Name</label>
                            <input type="text" class="form-control " name="reg_user_name" id="reg_user_name" placeholder="User Name" value="{{ old('reg_date') }}">
                        </div>

                        <div class="form-group">
                            <label for="company_name">Password</label>
                            <input type="text" class="form-control" name="reg_password" id="reg_password" placeholder="Password" value="{{ old('reg_date') }}">
                        </div>

                        <div class="form-group">
                            <label for="company_name">Email</label>
                            <input type="text" class="form-control" name="reg_email" id="reg_email" placeholder="Email" value="{{ old('reg_email') }}">
                        </div>

                    </div>

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Add Company">
                </div>
            </form>

        </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
