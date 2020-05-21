<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Validator;
use Response;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

use CodeItNow\BarcodeBundle\Utils\QrCode;

class InvoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createInvoice($company_id=null)
    {

        $companies = \App\Company::orderBy('name')->pluck('name', 'id');
        if(!empty($company_id)){
            $company = \App\Company::where('id',$company_id)->first();
            $data['company']=$company;
        }
        $data['companies']=$companies;
        $data['company_id']=$company_id;
        return view('backend.invoice.create-invoice',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
          //  'CompanyName' => 'required',
            'invoiceNo'   => 'required|unique:invoices,invoice_id'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        // $request->validate([
        //     'CompanyName' => 'required',
        //     'invoiceNo'   => 'required|unique:invoices,invoice_id'
        // ]);

        $invoice                = new \App\Invoice;

        $invoice->invoice_id    = $request->invoiceNo;
        $invoice->company_id    = $request->CompanyName;
        $invoice->invoice_total = $request->invoice_total;
        $invoice->invoice_subtotal = $request->invoice_subtotal;
      //  $invoice->tax_percent   = $request->tax_percent;
        $invoice->vat           = $request->vat;
        $invoice->discount      = $request->discount;
        $invoice->amount_paid   = $request->amount_paid;
        $invoice->amount_due    = $request->amount_due;
        $invoice->notes         = $request->notes;

        //$invoice->address    = $request->address;
        $invoice->name         = $request->name;
        $invoice->designation  = $request->designation;

        $invoice->address    = $request->address;
        $invoice->country    = $request->country;
        $invoice->district   = $request->district;
        $invoice->city       = $request->city;
        $invoice->postcode   = $request->postcode;
        $invoice->email      = $request->email;
        $invoice->phone_no   = $request->phone_no;



        $invoice->invoice_date  = date_format(date_create($request->invoiceDate),'Y-m-d');
        $invoice->due_date  = date_format(date_create($request->due_date),'Y-m-d');



        $invoice->save();
        if(count($request->total)){
            saveInvoiceDetail($request->description,$request->total,$invoice->id);
        }
        if($invoice){
            $response = array(
                'status' => 'success',
                'message' => 'Invoice added successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }

        // return redirect()->back()->with('message', 'Invoice added successfully. ');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allInvoices()
    {

        $companies = \App\Company::orderBy('name','ASC')
                                   ->pluck('name', 'id');

        $data['companies']=$companies;
        $invoices_q = \App\Invoice::orderBy('created_at','DESC');

        if(!empty($_GET['company'])){
            $company=trim($_GET['company']);
            $invoices_q->where('company_id',$company);
        }

        if(!empty($_GET['invoiceDate'])){
            $invoiceDate=trim($_GET['invoiceDate']);
            $invoices_q->whereDate('invoice_date','=', date('Y-m-d',strtotime($invoiceDate)));
        }
        if(!empty($_GET['query'])){
            $search=trim($_GET['query']);
            $invoices_q->where('invoice_id', 'like', '%' . $search . '%')
                                        ->orWhere('district', 'like', '%' . $search . '%')
                                        ->orWhere('city', 'like', '%' . $search . '%')
                                        ->orWhere('postcode', 'like', '%' . $search . '%')
                                        ->orWhere('email', 'like', '%' . $search . '%')
                                        ->orWhere('phone_no', 'like', '%' . $search . '%');
        }
        
        $invoices = $invoices_q->paginate(15);
        $data['invoices']=$invoices;
        return view('backend.invoice.invoices',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoice($invoice_id)
    {
        $invoice = \App\Invoice::where('id',$invoice_id)->first();
        $data['invoice']=$invoice;
        return view('backend.invoice.invoice',$data);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteInvoice(Request $request,$id)
    {
        \App\Invoice::where('id',$id)->delete();
        return redirect()->back()->with('message', 'Company deleted successfully.');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editInvoice($invoice_id)
    {
        $companies = \App\Company::orderBy('name')->pluck('name', 'id');
        $invoice = \App\Invoice::where('id',$invoice_id)->first();
        $data['invoice']=$invoice;
        $data['companies']=$companies;
        return view('backend.invoice.edit-invoice',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateInvoice(Request $request,$invoice_id)
    {



        $validator = Validator::make($request->all(), [
           // 'CompanyName' => 'required',
            'invoiceNo'   => 'required|unique:invoices,invoice_id,'.$invoice_id,
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        // $request->validate([
        //     'CompanyName' => 'required',
        //     'invoiceNo'   => 'required|unique:invoices,invoice_id,'.$invoice_id,
        // ]);

        $invoice                =  \App\Invoice::where('id',$invoice_id)->first();

        //$invoice->invoice_id    = $request->invoiceNo;
        $invoice->company_id    = $request->CompanyName;
        $invoice->invoice_total = $request->invoice_total;
        $invoice->invoice_subtotal = $request->invoice_subtotal;
       // $invoice->tax_percent   = $request->tax_percent;
       // $invoice->vat           = $request->tax;
        //$invoice->discount      = $request->amount_due;

        $invoice->vat           = $request->vat;
        $invoice->discount      = $request->discount;

        $invoice->amount_paid   = $request->amount_paid;
        $invoice->amount_due    = $request->amount_due;

        $invoice->invoice_date  = date_format(date_create($request->invoiceDate),'Y-m-d');
        $invoice->due_date      = date_format(date_create($request->due_date),'Y-m-d');

        $invoice->name         = $request->name;
        $invoice->designation  = $request->designation;

        $invoice->address    = $request->address;
        $invoice->country    = $request->country;
        $invoice->district   = $request->district;
        $invoice->city       = $request->city;
        $invoice->postcode   = $request->postcode;
        $invoice->email      = $request->email;
        $invoice->phone_no   = $request->phone_no;

        $invoice->notes      = $request->notes;

        $invoice->save();
        saveInvoiceDetail($request->description,$request->total,$invoice->id);
       // return redirect()->back()->with('message', 'Invoice updated successfully. ');

       if($invoice){
        $response = array(
            'status' => 'success',
            'message' => 'Invoice updated successfully.',
        );
        return Response::json($response);
    }else{
        $response = array(
            'status' => 'fail',
            'message' => 'Something wrong please try again!',
        );
        return Response::json($response);
    }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createInvoicePdf($invoice_id)
    {

        $invoice = \App\Invoice::where('id',$invoice_id)->first();
        $data['invoice']=$invoice;

        $qrCode = new QrCode();
        $qrCode
           ->setText('#'.$invoice->invoice_id.'TK'.$invoice->invoice_total)
           ->setSize(80)
           ->setPadding(0)
           ->setErrorCorrection('high')
           ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
           ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
           ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $data['barcode']= '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';

        $pdf = PDF::loadView('backend.invoice.pdf.invoice', $data);

        return $pdf->stream($invoice->invoice_id.'_invoice.pdf');

      //  return view('backend.invoice.invoice',$data);

    }
}
