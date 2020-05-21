<?php
function saveInvoiceDetail($description,$total, $invoice_id = ''){

    \App\InvoiceDetail::where('invoice_id',$invoice_id)->delete();

    for($i = 0 ; $i < count($total) ; $i++){
        if(!empty($total[$i])){
            $invoice               = new \App\InvoiceDetail;
            $invoice->invoice_id   =$invoice_id;
            $invoice->description  =$description[$i];
            $invoice->amount       =$total[$i];
            $invoice->save();
        }

    }


}

?>
