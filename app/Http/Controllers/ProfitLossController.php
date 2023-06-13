<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpenseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitLossController extends Controller
{
    public function index()
    {
        $data['expense'] = ExpenseModel::with('client', 'category_name', 'service_ty', 'sub_category', 'pay_m')->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        
        $data['expense'] = DB::select("
                SELECT year_and_month, SUM(total_sales) AS total_sales, SUM(total_expense) AS total_expense 
                FROM (
                    SELECT DATE_FORMAT(date, '%Y-%m') AS year_and_month, amount AS total_sales, NULL AS total_expense
                    FROM expense_report
                    UNION ALL
                    SELECT DATE_FORMAT(date, '%Y-%m') AS year_and_month, NULL AS total_sales, amount AS total_expense
                    FROM sale_report
                ) AS data
                GROUP BY year_and_month
                ");
        
        return view('profit_loss/list',$data);
    }

   
}
