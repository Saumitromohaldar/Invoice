@extends('backend.layouts.app')
@section('title', 'Invoices')
@section('content')
<section class="content-header">
        <h1>
            Invoices
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Invoices</li>
        </ol>
    </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">All Invoices</h3>
                    <div class="pull-right">
                        <a class="btn btn-block btn-primary btn-sm" href="{{ route('create-invoice') }}">Add Invoice</a>
                    </div>
                </div>



                

                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="callout callout-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{route('invoices')}}" method="GET">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="query" value="{{!empty($_GET['query'])?$_GET['query']:''}}" placeholder="Search Invoice">                            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" placeholder="Select Date" value="{{!empty($_GET['invoiceDate'])?$_GET['invoiceDate']:''}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 {!! Form::select('company', $companies, !empty($_GET['company'])?$_GET['company']:'', ['class' => 'form-control select2','placeholder'=>'Select Company']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>
                    </form>
                </div>

                @include('backend.invoice.data')


            </div>
         </div>


        </div>
        <!-- /.row -->

        <!-- /.row (main row) -->

      </section>
@endsection
