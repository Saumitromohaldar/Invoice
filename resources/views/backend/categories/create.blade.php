@extends('backend.layouts.app')
@section('title', 'Add Category')
@section('content')
    <section class="content-header">
        <h1>
            Add Category
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">Add Category</h3>
            </div>

            <form method="POST" id="save-category" action="{{route('categories.store')}}">
                @csrf
                <div class="box-body">

                    @if(session()->has('message'))
                        <div class="callout callout-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    
                    <div class="col-md-12">  
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{ old('name') }}">
                            <span class="help-block display-none error_name error_message"></span>
                            @if($errors->has('name'))
                                <span class="help-block">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' :'' }}">
                            <label for="type">Category Type</label>
                            {!! Form::select('type', ['Income'=>'Income','Expense'=>'Expense'], 'Income',['class' => 'form-control select2','placeholder'=>'Select Type' ,'id'=>'district']) !!}                            
                            <span class="help-block display-none error_type error_message"></span>
                            @if($errors->has('type'))
                                <span class="help-block">{{$errors->first('type')}}</span>
                            @endif
                        </div>
                    </div> 

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Add Category">
                </div>
            </form>

        </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
