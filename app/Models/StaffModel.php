<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;
    protected $table = 'admin';

    public function roles() {
        return $this->belongsTo(RoleModel::class,'role_id','id');
    }

    public function access() {
        return $this->hasMany(UserAccessModel::class,'user_id','id');
    }
}
