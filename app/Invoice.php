<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    function invoice_details(){
        return $this->hasMany('\App\InvoiceDetail','invoice_id');
    }
    function company(){
        return $this->belongsTo('\App\Company','company_id');
    }
}
