<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarModel extends Model
{
    use HasFactory;
    protected $table = 'navigation_bar';

    public function getusersidebardetails()
    {
        return $this->belongsTo(UserAccessModel::class,'id','nav_id');
    }

}
