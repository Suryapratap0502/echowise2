<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ClientModel;
use App\Models\ExpenseModel;
use App\Models\ProductModel;
use App\Models\SalesModel;
use App\Models\StaffModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
   public function index()
   {
      $user_data = StaffModel::with('roles')->where('id', '!=', '1')->where('flag', '!=', '2')->get();
      $data['total_sale'] = SalesModel::where('flag', '!=', '2')->sum('amount');
      $data['total_expense'] = ExpenseModel::where('flag', '!=', '2')->orderBy('id', 'DESC')->sum('amount');
      $client_data = ClientModel::where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
      // Sales Data
      $data['today_sale'] = $today_sale = SalesModel::where('flag', '!=', '2')->where('payment_date', date('Y-m-d'))->sum('amount');
      $data['this_month_sales'] = $this_month_sale = SalesModel::where('flag', '!=', '2')->whereYear('payment_date', date('Y-m'))->sum('amount');
      // Expense Data
      $data['today_expense'] = $today_exp = ExpenseModel::where('flag', '!=', '2')->where('date_of_payment', date('Y-m-d'))->sum('amount');
      $data['this_month_expense'] = $this_month_exp = ExpenseModel::where('flag', '!=', '2')->whereYear('date_of_payment', date('Y-m'))->sum('amount');
      // Top 3 Products (Sale)
      $data['sale_data'] = SalesModel::with('product')->where('flag', '!=', '2')->orderBy('amount', 'DESC')->limit(3)->get();
      // Top 3 Clients (Expense)
      $data['expense_data'] = ExpenseModel::with('client')->where('flag', '!=', '2')->orderBy('amount', 'DESC')->limit(3)->get();
      // get min & max month for cashflow

      $data['month_chart'] = $minmax = SalesModel::select(DB::raw('LEFT(`payment_date`, 7) as `month`'))->get();
      $data['exp_chart'] = $exp_chart_month = ExpenseModel::select(DB::raw('LEFT(`date_of_payment`, 7) as `month`'))->get();

      $data['min_month'] = $minmax->min('month');
      $data['max_month'] = $minmax->max('month');
      $data['sale'] = $sale = SalesModel::where('flag', '!=', '2')->sum('amount');
      $data['expense'] = $expense = ExpenseModel::where('flag', '!=', '2')->sum('amount');
      //today cashflow
      $data['today_cashflow'] = ($today_sale - $today_exp);
      $data['curr_month_cashflow'] = ($this_month_sale - $this_month_exp);
      $data['total_cash_flow'] = ($sale - $expense);
      $data['sale_chart'] = $sale = SalesModel::where('flag', '!=', '2')->get();
      $data['total_user'] = $user_data->count();
      $data['total_client'] = $client_data->count();

      // Anther User Dashboard
      $data['total_category'] = CategoryModel::where('flag', '!=', '2')->count('id');
      $data['total_subcategory'] = SubcategoryModel::where('flag', '!=', '2')->count('id');
      $data['total_products'] = ProductModel::where('flag', '!=', '2')->count('id');
      // End


      $arrs = array();
      $top_4_amount = DB::select("SELECT item_name, SUM(sale_report.amount) as amount FROM sale_report GROUP BY sale_report.item_name ORDER BY SUM(sale_report.amount) desc limit 5");
      foreach ($top_4_amount as $val1) {
         $prodata = array();
         foreach ($minmax as $val) {
            $pro_list = DB::select("SELECT SUM(sale_report.amount) as amount FROM sale_report JOIN product ON product.id = sale_report.item_name WHERE sale_report.item_name = '" . $val1->item_name . "' AND LEFT(`payment_date`, 7) = '" . $val->month . "' GROUP BY sale_report.item_name");            
            
            if(!empty($pro_list)) {
               $prodata[] = $pro_list[0]->amount;
            }else{
               $prodata[] = '0';
            }
         }

         $pro_name = ProductModel::where('id',$val1->item_name)->first();

         array_push($arrs, array('name' => $pro_name->name, 'data' => $prodata));
      }

      $data['arrs'] = $arrs;


      $arrs_exp = array();
      $top_4_amount_exp = DB::select("SELECT client_id, SUM(expense_report.amount) as amount FROM expense_report GROUP BY expense_report.client_id ORDER BY SUM(expense_report.amount) desc limit 5");
      foreach ($top_4_amount_exp as $val1) {
         $cl_data = array();
         foreach ($exp_chart_month as $val) {
            $cl_list = DB::select("SELECT SUM(expense_report.amount) as amount FROM expense_report JOIN client ON client.id = expense_report.client_id WHERE expense_report.client_id = '" . $val1->client_id . "' AND LEFT(`date_of_payment`, 7) = '" . $val->month . "' GROUP BY expense_report.client_id");            
            if(!empty($cl_list)) {
               $cl_data[] = $cl_list[0]->amount;
            }else{
               $cl_data[] = '0';
            }
         }

         $cl_name = ClientModel::where('id',$val1->client_id)->first();

         array_push($arrs_exp, array('name' => $cl_name->name, 'data' => $cl_data));
      }

      $data['arrs_exp'] = $arrs_exp;

      return view('dashboard', $data);
   }

   public function total_cashflow()
   {
      $sale = SalesModel::where('flag', '!=', '2')->get('amount');
      return $sale;
   }

   public function get_date(Request $request)
   {
      $id = $request->amt;
      $date = SalesModel::where('flag', '!=', '2')->where('amount', $id)->get('payment_date');
      return $date;
   }
}
