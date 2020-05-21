@extends('backend.layouts.app')
@section('title', 'Add Invoice')
@section('content')
    <section class="content-header">
        <h1>
            Add Invoice
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Invoice</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <div class="box box-info">

            <form method="POST" id="save-invoice" action="{{route('save-invoice')}}">
                @csrf
                <div class="box-body">

                    @if(session()->has('message'))
                        <div class="callout callout-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif


                    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                        <h4>Invoice To</h4>

                        <div class="form-group {{ $errors->has('CompanyName') ? 'has-error' :'' }}">
                            <label for="">Select Company Name</label>
                            {!! Form::select('CompanyName', $companies,!empty($company_id)?$company_id:null, ['class' => 'form-control select2','id'=>"clientCompanyName",'placeholder'=>'Select Company']) !!}
                            <span class="help-block display-none error_CompanyName error_message"></span>
                            @if($errors->has('CompanyName'))
                                <span class="help-block">{{$errors->first('CompanyName')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="" >
                        </div>

                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="" >
                        </div>


                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{!empty($company->address)?$company->address:''}}" >
                        </div>
                        @php
                            $countryList=Config::get('constants.countries');
                            $districtList=Config::get('constants.districts');                            
                            $upazilasList=Config::get('constants.upazilas');
                        @endphp
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
                            {!! Form::select('country', $countryList, !empty($company->country)?$company->country:'Bangladesh', ['class' => 'form-control select2','placeholder'=>'Select Country']) !!}
                        </div>
                        <div class="form-group ">
                           
                            {!! Form::label('district', 'District', ['class' => 'control-label']) !!}
                            {!! Form::select('district', $districtList, !empty($company->district)?$company->district:'',['class' => 'form-control select2','placeholder'=>'Select District' ,'id'=>'district']) !!}

                            {{-- <label for="district">District</label>
                            <input type="text" class="form-control" name="district" id="district" placeholder="District" value="{{!empty($company->district)?$company->district:''}}"> --}}
                        </div>

                        <div class="form-group ">
                            <label for="city">Thana</label>
                           
                            {{-- <input type="text" class="form-control" name="city"  id="city" placeholder="City" value="{{ !empty($company->city)?$company->city:'' }}"> --}}

                            {!! Form::select('city', $upazilasList, !empty($company->city)?$company->city:'',['class' => 'form-control select2','placeholder'=>'Select Thana' ,'id'=>'city']) !!}
                            
                        </div>

                        <div class="form-group ">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" value="{{ !empty($company->postcode)?$company->postcode:'' }}">
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label for="company_name">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ !empty($company->email)?$company->email:'' }}">
                            <span class="help-block display-none error_email error_message"></span>
                            @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="company_name">Phone</label>
                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone" value="{{ !empty($company->phone_no)?$company->phone_no:'' }}">
                        </div>

                    </div>

                    @php
                        $lastInvoiceID = \App\Invoice::orderBy('id', 'DESC')->pluck('invoice_id')->first();
                        $newInvoiceID =sprintf("%04d",  $lastInvoiceID + 1);
                    @endphp

                    <div class="col-xs-12 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-sm-4 col-md-4 col-lg-4">
                        <h4>&nbsp;</h4>
                        <div class="form-group {{ $errors->has('invoiceNo') ? 'has-error' :'' }}">
                            <label for="company_name">Invoice No</label>
                            <input type="text" class="form-control" name="invoiceNo" id="invoiceNo" placeholder="Invoice No"  readonly value="{{$newInvoiceID}}">
                            <span class="help-block display-none error_invoiceNo error_message"></span>
                            @if($errors->has('invoiceNo'))
                                <span class="help-block">{{$errors->first('invoiceNo')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="invoiceDate">Invoice Date</label>
                            <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date" value="{{date('d-m-Y')}}">
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="text" class="form-control " name="due_date" id="due_date" placeholder="Due Date" value="{{date('d-m-Y')}}">
                        </div>
                    </div>


                    <table class="table table-bordered table-hover" id="invoiceTable">
                        <thead>
                            <tr>
                                <th width="2%" class="vertical-align-center text-center"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                <th width="38%">Description</th>
                                <th width="15%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="vertical-align-center text-center"><input class="case" type="checkbox"/></td>
                                <td><input type="text" data-type="description" data-type="productCode" name="description[]" id="description_1" class="form-control autocomplete_txt " autocomplete="off"></td>
                                <td><input type="text" name="total[]" id="total_1" class="form-control totalLinePrice autocomplete_txt changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                            </tr>
                        </tbody>
                    </table>

                    <span class="help-block display-none error_total.0 error_message"></span>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <button id="delete" class="btn btn-danger delete" type="button">- Delete</button>
                        <button id="addmore" class="btn btn-success addmore" type="button">+ Add </button>
                        <h2>Notes: </h2>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3">

                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">TK</div>
                                <input type="text" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">TK</div>
                                <input type="text" class="form-control changesNo" name="vat" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                {{-- <div class="input-group-addon">%</div> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Less: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">TK</div>
                                <input type="text" class="form-control changesNo" name="discount" id="discount" placeholder="Less" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">TK</div>
                                <input type="text" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Amount Paid: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">TK</div>
                                <input type="text" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Amount Due: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Tk</div>
                                <input type="text" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Save Invoice">
                </div>
            </form>

        </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
