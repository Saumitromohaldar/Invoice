<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Invoice;
use Illuminate\Support\Facades\Storage;

use PDF;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use Illuminate\Support\Facades\Validator;


class MailController extends Controller
{
    public function sendMail(Request $request,$invoice_id)
    {


            
            $v = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

            if ($v->fails())
            {
                return redirect()->back()->withErrors($v->errors());
            }

            $invoice=Invoice::where('id',$invoice_id)->first();
            $data['invoice']=$invoice;
            $qrCode = new QrCode();
            $qrCode->setText('#'.$invoice->invoice_id.'TK'.$invoice->invoice_total)
               ->setSize(80)
               ->setPadding(0)
               ->setErrorCorrection('high')
               ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
               ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
               ->setImageType(QrCode::IMAGE_TYPE_PNG);
               
            $data['barcode']= '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';
    
            $pdf = PDF::loadView('backend.invoice.pdf.invoice', $data);

            Storage::put('invoice/'.$invoice->invoice_id.'_invoice.pdf', $pdf->output());          

            $file_path =storage_path('app/invoice/'.$invoice->invoice_id.'_invoice.pdf');
            $to=trim($request->email);
           
            $invoiceId=$invoice->invoice_id;
            Mail::send('mail.mail', $data, function ($message) use ($to,$file_path,$invoiceId) {

                $message->from('contact@rakibtrade.com','Rakib Trade');
                $message->to($to)->subject('Invoice');                    
                $message->attach($file_path,array(
                    'as' => $invoiceId.'_invoice.pdf')
                );
           
            });

        if (Mail::failures()) {

            return redirect()->back()->with(['error'=>'Something wrong. Please try again.']);
            

        }else{
            $invoice->mail_send=1;
            $invoice->save();
            Storage::delete('invoice/'.$invoice->invoice_id.'_invoice.pdf');
            return redirect()->back()->with(['success'=>'Invoice sent successfully.']);
        }


    }
}
