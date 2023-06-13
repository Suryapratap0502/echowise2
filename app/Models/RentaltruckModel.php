<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentaltruckModel extends Model
{
    use HasFactory;
    protected $table = 'rental_truck';
    public function clients()
    {
        return $this->belongsTo(ClientModel::class,'client','id');
    }

    public function site_1()
    {
        return $this->belongsTo(SiteModel::class,'site','id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleModel::class,'vehicle_no','id');
    }
}
