@extends('backend.layouts.app')
@section('title', 'Edit '.$incomeExpense->type)
@section('content')
    <section class="content-header">
        <h1>
            Edit {{ $incomeExpense->type }}
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit {{ $incomeExpense->type }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit {{ $incomeExpense->type }}</h3>
                </div>
               
                
                    <form method="POST" id="update-income_expense" action="{{ route('income_expenses.update',$incomeExpense->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                       
                        @if(session()->has('message'))
                            <div class="callout callout-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label for="date">Date</label>
                            <input type="text" class="form-control date_field" name="date" placeholder="Date" value="{{date('d-m-Y',strtotime($incomeExpense->date))}}">
                                <span class="help-block display-none error_date error_message"></span>
                                @if($errors->has('date'))
                                    <span class="help-block">{{$errors->first('date')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label for="category">Category</label>
                                {!! Form::select('category', $categories,$incomeExpense->category_id,['class' => 'form-control select2','placeholder'=>'Select Category' ,'id'=>'category']) !!}                            
                                <span class="help-block display-none error_category error_message"></span>
                                @if($errors->has('category'))
                                    <span class="help-block">{{$errors->first('category')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">  
                            <div class="form-group {{ $errors->has('amount') ? 'has-error' :'' }}">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$incomeExpense->amount}}">
                                <span class="help-block display-none error_amount error_message"></span>
                                @if($errors->has('amount'))
                                    <span class="help-block">{{$errors->first('amount')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">  
                            <div class="form-group {{ $errors->has('note') ? 'has-error' :'' }}">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" name="note" placeholder="Note" value="{{$incomeExpense->note}}">
                                <span class="help-block display-none error_name error_message"></span>
                                @if($errors->has('note'))
                                    <span class="help-block">{{$errors->first('note')}}</span>
                                @endif
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
