<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'cat_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubcategoryModel::class, 'sub_cat_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubsubcatModel::class, 'sub_sub_cat_id', 'id');
    }
}
