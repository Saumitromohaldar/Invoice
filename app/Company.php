<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    function invoices(){
        return $this->hasMany('\App\Invoice','company_id');
    }
}
