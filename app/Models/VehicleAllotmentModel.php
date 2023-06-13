<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleAllotmentModel extends Model
{
    use HasFactory;
    protected $table = 'allotment_vehicle';

    public function admin()
    {
        return $this->belongsTo(AdminModel::class,'driver_id','id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleModel::class,'vehicle_id','id');
    }
}
