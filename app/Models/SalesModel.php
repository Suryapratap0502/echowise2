<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    use HasFactory;
    protected $table = 'sale_report'; 
    
    public function product()
    {
        return $this->belongsTo(ProductModel::class,'item_name','id');
    }
    
}
