<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="content-type" content="text-html; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('/css/pdf.css') }}" media="all" />
</head>

<body>

	<header class="clearfix">
        <div class="">
            <img class="pad-header" src="{{asset('backend/images/pad-header.png')}}" alt="">            
        </div>
    </header>

    <footer>
        {{-- <div for="" class="mb-5 fs-17 font-weight-bold text-center payment-title" >Payment Method</div> --}}

        <div class="" style="padding-left:50px; padding-right:50px;">            
            <div class="clear"></div>
            
            <div class="notice text-left" style="vertical-align: bottom;padding-bottom:9px">          
                
                    <div class="mb-5 font-weight-bold" style="">Mobile Payment</div>     
                    <div class="mb-5"><img src="https://www.bkash.com/sites/all/themes/bkash/logo-bn.png?87980" alt="" width="30" style="margin-top:5px;"> Bkash Personal: 01720-901890 </div>
                    <div class="mb-5">  <img src="{{asset('backend/images/rocket.png')}}" alt=""  width="30" style="margin-top:2px;"> Rocket Personal: 01720-901890-5 </div>
                    <div class="mb-5 ">  <img src="https://nagad.com.bd/wp-content/uploads/2019/04/Nagad_Logo_for_web__128x53.svg" alt=""  width="30" style="margin-top:2px;"> Nagad: 01720-901890</div>
                
            </div>
            <div class="barcode ">
                {!! $barcode !!}
            </div>
            <div class="notice text-left">       
                <div class="mb-5 font-weight-bold">Bank Payment</div>           
                <div class="mb-5"> Rakib Business Associate Firm</div>
                <div class="mb-5">A/C. No. 0023-1460000599</div>
                <div class="mb-5"><img src="https://www.midlandbankbd.net/wp-content/uploads/2018/08/MDB-Logo-Regular.png" alt=""  width="30" style="margin-top:5px;">   Midland Bank Ltd.</div>
                <div class="">Khulna Branch, Khulna</div>
            </div>
        </div>
        <div class="text-center mb-5 font-weight-bold mt-5">This is a computer generated Invoice does not require a signature and seal.</div>

        <div class="end "><b>Our Services:</b> New Private Limited & Public Limited Company, Society, Partnership, Firm, Trade Organization Registration & Mortgage Registration / Charge Creation, Yearly Return, Share Transfer, Memorandum & Articales Amendment, Certified Copy, Search Report Accounts Preparation & Audit Report, Online Submission Regarding Joint Stock Company (RJSC),Share Certificate, Share Register & Share Trasfer Register, TIN Certification Registration & Return Filling, VAT Registration Certificate / BIN Certificate, Import Registration Certificate (IRC). Export Registration Certificate (ERC), Project Profile & Consultancy, All Kinds of Foreign Investment Consultancy, Group of Company, Cember of Commerce & Industry Registration, Winding Up, Struck Up, Bank Loan, Mortgage Certificate, Security Exchange Commission Permission, BSTI, Fire License, Environment Clearance, Trade Mark, Trade Licence, Logo Registration & Anything Legal your require.</div>

    </footer>

    <div id="watermark">
        <img src="{{asset('backend/images/logo.png')}}" height="100%" width="100%" />
    </div>

    <section>

        @if(!empty($invoice->amount_paid) && $invoice->invoice_total<=$invoice->amount_paid)
            <div class="wrap">
                <span class="ribbon6">Paid</span>
            </div>

        @elseif(!empty($invoice->amount_paid))
            <div class="wrap partial-due">
                <span class="ribbon6">Due</span>
            </div>
        @else
            <div class="wrap due">
                <span class="ribbon6">Due</span>
            </div>
        @endif

        <div class="container">

            <div class="details clearfix">


                <div class="client left">
                    <p>INVOICE TO:</p>
                    @if(!empty($invoice->name))
                    <p class="name">{{$invoice->name}}</p>
                    @endif
                    @if(!empty($invoice->designation))
                    <p class="name">{{$invoice->designation}}</p>
                    @endif
                    <p class="name">{{  !empty($invoice->company->name)?$invoice->company->name:'' }}</p>
                    <p> {{$invoice->address}}</p>
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
                        <p>Invoice Date: {{date_format(date_create($invoice->invoice_date),'d/m/Y')}}</p>
                        <p>Due Date: {{date_format(date_create($invoice->invoice_date),'d/m/Y')}}</p>
                    </div>
                </div>

            </div>

            <table border="0" cellspacing="0" cellpadding="0">

                <thead>
                    <tr>
                        <th class="sl-no">SL NO</th>
                        <th class="desc">Description</th>
                        <th class="total">Amount</th>
                    </tr>
                </thead>

                <tbody>

                    @if(count($invoice->invoice_details))
                        @foreach($invoice->invoice_details as $key=>$invoice_detail)

                        <tr>
                            <td class="sl-no">{{$key+1}}</td>
                            <td class="desc">{{$invoice_detail->description}}</td>
                            <td class="total">TK {{number_format($invoice_detail->amount,2)}}</td>
                        </tr>

                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="no-break">
                <table class="grand-total">
                    <tbody>

                        <tr>
                            <td class="desc"></td>
                            <td class="qty"></td>
                            <td class="unit">SUBTOTAL:</td>
                            <td class="total">TK {{ number_format($invoice->invoice_subtotal,2) }}</td>
                        </tr>
                        @if(!empty($invoice->vat))
                        <tr>
                            <td class="desc"></td>
                            <td class="qty"></td>
                            <td class="unit">TAX:</td>
                            <td class="total">TK {{ number_format($invoice->vat,2) }}</td>
                        </tr>
                        @endif
                        @if(!empty($invoice->discount))
                        <tr>
                            <td class="desc"></td>
                            <td class="qty"></td>
                            <td class="unit">LESS:</td>
                            <td class="total">TK {{ number_format($invoice->discount,2) }}</td>
                        </tr>
                        @endif


                        <tr class="height_light">
                            <td class="desc"></td>
                            <td class="unit" colspan="2">GRAND TOTAL:</td>
                            <td class="total">TK {{number_format($invoice->invoice_total,2)}}</td>
                        </tr>

                        <tr>
                            <td class="desc"></td>
                            <td class="unit" colspan="2">PAID:</td>
                            <td class="total">TK {{!empty($invoice->amount_paid)?number_format($invoice->amount_paid,2):'0.00'}}</td>
                        </tr>

                        <tr class="height_light">
                            <td class="desc"></td>
                            <td class="unit" colspan="2">DUE:</td>
                            <td class="total">TK {{!empty($invoice->amount_due)?number_format($invoice->amount_due,2):'0.00'}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>



        </div>


    </section>
</body>

</html>
