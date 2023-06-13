<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    use HasFactory;
    protected $table = 'expense_report';

    public function client()
    {
        return $this->belongsTo(ClientModel::class,'client_id','id');
    }

    public function category_name()
    {
        return $this->belongsTo(CategoryModel::class,'category','id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubcategoryModel::class,'subcategory','id');
    }

    public function service_ty()
    {
        return $this->belongsTo(ServicetypeModel::class,'service_type','id');
    }
    public function pay_m()
    {
        return $this->belongsTo(CashmanagementModel::class,'pay_mode','id');
    }
}
