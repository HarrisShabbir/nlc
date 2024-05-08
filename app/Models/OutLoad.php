<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutLoad extends Model
{
    use HasFactory;

    public function articledetails()
    {
        return $this->morphedByMany(OutLoad::class, 'detailable','article_details','detailable_id');
    }

    public function vehicledetails()
    {
        return $this->morphedByMany(OutLoad::class, 'detailable', 'vehicle_details', 'detailable_id');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function vendor_pool()
    {
        return $this->belongsTo(VendorPool::class);
    }
}
