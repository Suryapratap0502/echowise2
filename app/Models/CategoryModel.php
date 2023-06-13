<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'category';

    public function service_type_1() {
        return $this->belongsTo(ServicetypeModel::class,'service_type','id');
    }
}
