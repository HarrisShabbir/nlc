<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function vendorpool(){
        return $this->belongsTo(VendorPool::class, 'vendor_pool_id');
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }
}
