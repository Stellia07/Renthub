<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaseAgreement extends Model
{
    protected $fillable = [
        'effective_date', 'homeowner_name', 'homeowner_address', 'renter_name',
        'renter_address', 'room_address', 'start_date', 'termination_notice_period',
        'termination_non_compliance_period', 'breach_correction_period',
        // Add any additional fields that should be mass assignable.
    ];


    // Adjust and add other necessary fields based on your agreement details
}
