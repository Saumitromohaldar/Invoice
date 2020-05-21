@extends('backend.layouts.app')
@section('title', 'Add Income/Expense')
@section('content')
    <section class="content-header">
        <h1>
            Add Income/Expense
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Income/Expense</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-6 ">
        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title">Add Income</h3>
            </div>

            <form method="POST" id="save-income" action="{{route('income_expenses.store')}}">
                @csrf
                <div class="box-body">

                    @if(session()->has('message'))
                        <div class="callout callout-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif                   
                    
                    <div class="col-md-4">  
                        <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                            <label for="date">Date</label>
                        <input type="text" class="form-control date_field" name="date" placeholder="Date" value="{{date('d-m-Y')}}">
                            <span class="help-block display-none error_date error_message"></span>
                            @if($errors->has('date'))
                                <span class="help-block">{{$errors->first('date')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">  
                        <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                            <label for="category">Category</label>
                            {!! Form::select('category', $income_categories,'',['class' => 'form-control select2','placeholder'=>'Select Category' ,'id'=>'category']) !!}                            
                            <span class="help-block display-none error_category error_message"></span>
                            @if($errors->has('category'))
                                <span class="help-block">{{$errors->first('category')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">  
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' :'' }}">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{old('amount')}}">
                            <span class="help-block display-none error_amount error_message"></span>
                            @if($errors->has('amount'))
                                <span class="help-block">{{$errors->first('amount')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">  
                        <div class="form-group {{ $errors->has('note') ? 'has-error' :'' }}">
                            <label for="note">Note</label>
                            <input type="text" class="form-control" name="note" placeholder="Note" value="{{old('note')}}">
                            <span class="help-block display-none error_name error_message"></span>
                            @if($errors->has('note'))
                                <span class="help-block">{{$errors->first('note')}}</span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" value="Income" name="type">

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>

        </div>
        </div>

        <div class="col-md-6 ">
            <div class="box box-info">
    
                <div class="box-header with-border">
                    <h3 class="box-title">Add Expense</h3>
                </div>
    
                <form method="POST" id="save-expense" action="{{route('income_expenses.store')}}">
                    @csrf
                    <div class="box-body">
    
                        @if(session()->has('message'))
                            <div class="callout callout-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label for="date">Date</label>
                            <input type="text" class="form-control date_field" name="date" placeholder="Date" value="{{date('d-m-Y')}}">
                                <span class="help-block display-none error_date error_message"></span>
                                @if($errors->has('date'))
                                    <span class="help-block">{{$errors->first('date')}}</span>
                                @endif
                            </div>
                        </div>
    
                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label for="category">Category</label>
                                {!! Form::select('category', $expense_categories,'',['class' => 'form-control select2','placeholder'=>'Select Category' ,'id'=>'category']) !!}                            
                                <span class="help-block display-none error_category error_message"></span>
                                @if($errors->has('category'))
                                    <span class="help-block">{{$errors->first('category')}}</span>
                                @endif
                            </div>
                        </div>
    
                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('amount') ? 'has-error' :'' }}">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{old('amount')}}">
                                <span class="help-block display-none error_amount error_message"></span>
                                @if($errors->has('amount'))
                                    <span class="help-block">{{$errors->first('amount')}}</span>
                                @endif
                            </div>
                        </div>
    
                        <div class="col-md-12">  
                            <div class="form-group {{ $errors->has('note') ? 'has-error' :'' }}">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" name="note" placeholder="Note" value="{{old('note')}}">
                                <span class="help-block display-none error_name error_message"></span>
                                @if($errors->has('note'))
                                    <span class="help-block">{{$errors->first('note')}}</span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" value="Expense" name="type">                        
                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>

                </form>
    
            </div>
            </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
