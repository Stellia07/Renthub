<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = ['date_of_payment', 'receipt_number', 'amount_paid', 'property_address', 'tenant_name', 'landlord_name'];
}
