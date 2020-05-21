@extends('backend.layouts.app')
@section('title','Invoice')
@section('content')
    <section class="content-header">
        <h1>
            Invoice
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Invoice</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <div class="box box-info pb-5 ribbon">
            @if(!empty($invoice->amount_paid) && $invoice->invoice_total<=$invoice->amount_paid)
                <div class="wrap ">
                <span class="ribbon6">Paid</span>
                </div>
            @elseif(!empty($invoice->amount_paid))
                <div class="wrap partial-due">
                    <span class="ribbon6">Due</span>
                </div>
            @else
                <div class="wrap due">
                    <span class="ribbon6 ">Due</span>
                </div>
            @endif

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <div class=" invoice-header clearfix">
                    <div class="">
                        <img class="pad-header" src="{{asset('backend/images/invoice-header.png')}}" alt="">    
                        {{-- <figure>
                            <img class="logo" src="{{asset('backend/images/logo.png')}}" alt="">
                        </figure>
                        <div class="company-address">
                            <h2 class="title">Rakib Trade</h2>
                            <p>
                                116 Sir Iqbal Road (Ground Floor), <br> Khulna-9100. Bangladesh.
                            </p>
                        </div>
                        <div class="company-contact">
                            Phone: +880-1720-901890 <br>
                            Email: rbassociatesfirm@gmail.com  <br>
                        </div> --}}
                    </div>
                </div>

                <div class="details clearfix">

                    <div class="client left ">
                        <p>INVOICE TO:</p>
                        @if(!empty($invoice->name))
                        <p class="name">{{$invoice->name}}</p>
                        @endif
                        @if(!empty($invoice->designation))
                        <p class="name">{{$invoice->designation}}</p>
                        @endif
                        <p class="name">{{ !empty($invoice->company->name)?$invoice->company->name:'' }}</p>
                        <p>{{$invoice->address}}</p>
                        <p> {{$invoice->city}}{{!empty($invoice->postcode)?'-'.$invoice->postcode:''}}{{!empty($invoice->district)?', '.$invoice->district:''}}, {{!empty($invoice->country)?$invoice->country.'.':''}}</p>
                        @if(!empty($invoice->phone_no))
                        <p>Phone: {{$invoice->phone_no}}</p>
                        @endif
                        @if(!empty($invoice->email))
                        <p>Email: {{$invoice->email}}</p>
                        @endif
                    </div>

                    <div class="data right">
                        <div class="title">Invoice #{{$invoice->invoice_id}}</div>
                        <div class="date">
                            Invoice Date: {{date_format(date_create($invoice->invoice_date),'d/m/Y')}}<br>
                            Due Date: {{date_format(date_create($invoice->due_date),'d/m/Y')}}
                        </div>
                    </div>

                </div>




                <!-- Table row -->
                <div class="row">
                    <div class="col-md-12 table-responsive">
                    <table class="">
                        <thead>
                        <tr>
                        <th class="number">#</th>
                        <th class="desc">Description</th>
                        <th class="total">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($invoice->invoice_details))
                            @foreach($invoice->invoice_details as $key=>$invoice_detail)
                            <tr>
                                <td class="number">{{$key+1}}</td>
                                <td class="desc">{{$invoice_detail->description}}</td>
                                <td class="total">TK {{number_format($invoice_detail->amount,2)}}</td>
                            </tr>
                            @endforeach
                        @endif


                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->

                    <!-- /.col -->
                    <div class="col-md-12">

                        <div class="no-break">
                                <table class="grand-total">
                                    <tbody>

                                        <tr>
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit">SUBTOTAL:</td>
                                            <td class="total">TK  {{ number_format($invoice->invoice_subtotal,2) }}</td>
                                        </tr>
                                        @if(!empty($invoice->discount))
                                        <tr>
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit" >TAX:</td>
                                            <td class="total">TK {{ number_format($invoice->vat,2)}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($invoice->discount))
                                        <tr>
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit" >LESS:</td>
                                            <td class="total">TK {{ number_format($invoice->discount,2)}}</td>
                                        </tr>
                                        @endif

                                        <tr class="height_light">
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit" >GRAND TOTAL:</td>
                                            <td class="total">TK {{ number_format($invoice->invoice_total,2)}}</td>
                                        </tr>

                                        <tr>
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit" >AMOUNT PAID:</td>
                                            <td class="total">TK {{!empty($invoice->amount_paid)?number_format($invoice->amount_paid,2):'0.00'}}</td>
                                        </tr>

                                        <tr class="height_light">
                                            <td class="desc"></td>
                                            <td class="qty"></td>
                                            <td class="unit">AMOUNT DUE:</td>
                                            <td class="total">TK {{!empty($invoice->amount_due)?number_format($invoice->amount_due,2):'0.00'}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>


                    </div>

                    <div class="col-md-12 mb-20">
                        @if(!empty($invoice->notes))
                            <p class="text-muted well1 b-1-solid-e3e3e3 well-sm shadow-none" style="margin-top: 10px;">
                                {{$invoice->notes}}
                            </p>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-md-3">
                    {{-- <a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
                    <a class="btn btn-primary float-right" href="{{route('create-pdf-invoice',['invoice_id'=>$invoice->id])}}" target="_blank" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Download PDF
                    </a>
                    </div>
                    <div class="col-md-9">
                        <form method="POST" action="{{route('send-mail',$invoice->id)}}" >
                            @csrf
                            <div class="input-group input-group-sm form-group">
                                <input type="text" class="form-control" name="email" value="{{ !empty($invoice->email)?$invoice->email:''}}" enctype="multipart/form-data">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-primary btn-flat" value="Send Mail">
                                </span>

                                
                                
                            </div>

                            @if (Session::has('success'))
                                <div class="alert alert-info">{{ Session::get('success') }}</div>
                            @endif

                            
                            @if (Session::has('error'))
                            
                            <div class="form-group has-error">
                                <span class="error_message help-block">                                
                                    {{ Session::get('error') }}                               
                                </span>
                            </div>
                            @endif
                            @if ($errors->has('email'))
                            
                            <div class="form-group has-error">
                                <span class="error_message help-block">                                
                                    {{ $errors->first('email') }}                               
                                </span>
                            </div>
                            @endif
                            
                        </form>
                    </div>


                </div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row (main row) -->
    </section>

@endsection
