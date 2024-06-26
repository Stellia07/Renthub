<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['tenant_id', 'file_path'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
