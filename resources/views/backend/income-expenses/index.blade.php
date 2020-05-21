@extends('backend.layouts.app')
@section('title', 'Income & Expense')
@section('content')
<section class="content-header">
        <h1>
            Income & Expense
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Income & Expense</li>
        </ol>
    </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         <div class="col-md-12">
            <div class="box box-info">

                <div class="box-header">
                    <h3 class="box-title">All Income & Expense</h3>

                    <div class="pull-right">
                        <a class="btn btn-block btn-primary btn-sm" href="{{ route('income_expenses.create') }}">Add Income/Expense</a>
                    </div>


                </div>

                @if(session()->has('message'))
                    <div class="callout callout-info">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="box-body">
                    {{-- <div class="col-md-4 ">
                        <form action="{{route('companies')}}" method="GET">
                            <div class="input-group input-group-sm form-group">
                                <input type="text" class="form-control" name="query" value="{{!empty($_GET['query'])?$_GET['query']:''}}">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </span>
                            </div>
                        </form>
                    </div> --}}
                    <div class="mb-6">
                        <div class="col-md-6">  
                            <a href="{{route('income_expenses.index')}}?filter_by=yearly" class="btn btn-primary">Yearly</a>
                            <a href="{{route('income_expenses.index')}}?filter_by=monthly" class="btn btn-primary">Monthly</a>
                            <a href="{{route('income_expenses.index')}}?filter_by=weekly" class="btn btn-primary">Weekly</a>
                            <a href="{{route('income_expenses.index')}}?filter_by=daily" class="btn btn-primary">Daily</a>
                        </div>
                        <div class="col-md-6">  
                            <form action="{{route('income_expenses.index')}}" method="GET">
                                <div class="col-md-4">  
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">                                    
                                        <input type="text" class="form-control date_field" name="start_date" placeholder="Date From" value="{{date('d-m-Y')}}">                                    
                                    </div>
                                </div>

                                <div class="col-md-4">  
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">                                    
                                        <input type="text" class="form-control date_field" name="end_date" placeholder="Date To" value="{{date('d-m-Y')}}">                                    
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Search">
                            </form>
                        </div>
                    </div>
                    @include('backend.income-expenses.data')

                    <div class="clear"></div>
                </div>

                <div class="clear"></div>
            </div>
         </div>


        </div>
        <!-- /.row -->

        <!-- /.row (main row) -->

      </section>
@endsection
