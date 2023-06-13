<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsubcatModel extends Model
{
    use HasFactory;
    protected $table = 'subsubcategory';

    public function category() {
        return $this->belongsTo(CategoryModel::class,'cat_id','id');
    }
    public function subcategory() {
        return $this->belongsTo(SubcategoryModel::class,'sub_cat_id','id');
    }

    public function service_type_1() {
        return $this->belongsTo(ServicetypeModel::class,'service_type','id');
    }
}
