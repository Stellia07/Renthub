<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'owner_name',
        'tenant_name',
        'tenant_email',
        'monthly_rent',
        'due_date',
        'status',
         'payment_date',
          'payment_month',
           'receipt_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
