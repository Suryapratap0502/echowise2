<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AdminModel extends Model
{
    use HasFactory;
    protected $table = 'admin';

    public static function deletedata($table,$id,$data) {
        return DB::table($table)->where('id',$id)->update($data);
    }

    public function role_name() {
        return $this->belongsTo(RoleModel::class,'role_id','id');
    }

    
}

