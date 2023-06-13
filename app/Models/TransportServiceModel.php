<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportServiceModel extends Model
{
    use HasFactory;
    protected $table = 'transportation_service';

    public function admin()
    {
        return $this->belongsTo(AdminModel::class,'driver_name','id');
    }

    public function vehicle_data()
    {
        return $this->belongsTo(VehicleModel::class,'vehicle_no','id');
    }

    public function site_1()
    {
        return $this->belongsTo(SiteModel::class,'start_destination','id');
    }
}
