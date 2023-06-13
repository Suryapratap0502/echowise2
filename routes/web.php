<?php

use App\Http\Controllers\CashmanagementController;
use App\Http\Controllers\CashreportController;
use App\Http\Controllers\Category;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HsnController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\RentalTruckController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServicetypeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Staff;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Subcategory;
use App\Http\Controllers\Subsubcategory;
use App\Http\Controllers\TransportServiceController;
use App\Http\Controllers\VehicleController;
use App\Models\RentaltruckModel;
use App\Models\SubsubcatModel;
use App\Models\TransportServiceModel;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [Dashboard::class, 'index']);
    Route::prefix('dashboard/')->group(function () {
        Route::get('total_cashflow', [Dashboard::class, 'total_cashflow']);
        Route::get('get_date', [Dashboard::class, 'get_date']);
    });
    Route::get('/user', [Staff::class, 'user_list']);
    Route::post('/add_user', [Staff::class, 'add_user']);
    Route::post('/show_edit_user', [Staff::class, 'show_edit_user']);
    Route::post('/update_user', [Staff::class, 'update_user']);
    Route::get('/fetch_user', [Staff::class, 'fetch_all_user']);
    Route::post('/delete_user', [Staff::class, 'delete_user']);
    Route::post('/update_status_user', [Staff::class, 'update_status_user']);
    Route::post('/filter_user_data', [Staff::class, 'filter_user_data']);
    Route::post('/filter_user_all_data', [Staff::class, 'filter_user_all_data']);
    Route::post('/get_access', [Staff::class, 'get_access']);
    Route::post('/change_password', [Staff::class, 'change_password']);
    Route::post('/update_password', [Staff::class, 'update_password']);
    Route::get('/category', [Category::class, 'category_list']);
    Route::get('/fetch_cat', [Category::class, 'fetch_cat']);
    Route::post('/add_category', [Category::class, 'add_category']);
    Route::post('/show_edit_category', [Category::class, 'show_edit_category']);
    Route::post('/update_category', [Category::class, 'update_category']);
    Route::post('/delete_cat', [Category::class, 'delete_cat']);
    Route::post('/update_status_category', [Category::class, 'update_status_category']);
    Route::get('/sub_category', [Subcategory::class, 'index']);
    Route::get('/fetch_subcat', [Subcategory::class, 'fetch_subcat']);
    Route::post('/add_subcategory', [Subcategory::class, 'add_subcategory']);
    Route::post('/show_edit_subcategory', [Subcategory::class, 'show_edit_subcategory']);
    Route::post('/update_subcategory', [Subcategory::class, 'update_subcategory']);
    Route::post('/update_status_subcategory', [Subcategory::class, 'update_status_subcategory']);
    Route::post('/delete_subcat', [Subcategory::class, 'delete_subcat']);
    Route::post('/get_cat_with_service_type', [Subcategory::class, 'get_cat_with_service_type']);
    Route::get('/sub_sub_category', [Subsubcategory::class, 'index']);
    Route::post('/getsubcat_with_cat_id', [Subsubcategory::class, 'getsubcat_with_cat_id']);
    Route::post('/getsubsubcat_with_subcat_id', [Subsubcategory::class, 'getsubsubcat_with_subcat_id']);
    Route::get('/fetch_subsubcat', [Subsubcategory::class, 'fetch_subsubcat']);
    Route::post('/add_sub_subcategory', [Subsubcategory::class, 'add_sub_subcategory']);
    Route::post('/show_edit_subsubcategory', [Subsubcategory::class, 'show_edit_subsubcategory']);
    Route::post('/update_sub_subcategory', [Subsubcategory::class, 'update_sub_subcategory']);
    Route::post('/delete_sub_subcat', [Subsubcategory::class, 'delete_sub_subcat']);
    Route::post('/update_status_sub_subcategory', [Subsubcategory::class, 'update_status_sub_subcategory']);

    Route::prefix('cash_management/')->group(function () {
        Route::get('', [CashmanagementController::class, 'index']);
        Route::get('fetch_pay_list', [CashmanagementController::class, 'fetch_pay_list']);
        Route::post('add_pay_method', [CashmanagementController::class, 'add_pay_method']);
        Route::post('show_edit_pay_method', [CashmanagementController::class, 'show_edit_pay_method']);
        Route::post('update', [CashmanagementController::class, 'update']);
    });
    Route::prefix('common_action/')->group(function () {
        Route::post('change_status', [CommonController::class, 'change_status']);
    });
    Route::prefix('product/')->group(function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('get_products', [ProductController::class, 'get_products']);
        Route::post('add_product', [ProductController::class, 'add_products']);
        Route::post('show_edit_product', [ProductController::class, 'show_edit_product']);
        Route::post('update', [ProductController::class, 'update']);
    });

    Route::prefix('hsn_management/')->group(function () {
        Route::get('', [HsnController::class, 'index']);
        Route::get('get_hsn', [HsnController::class, 'get_hsn']);
        Route::post('add_hsn', [HsnController::class, 'add_hsn']);
        Route::post('show_edit_hsn', [HsnController::class, 'show_edit_hsn']);
        Route::post('update', [HsnController::class, 'update']);
    });

    Route::prefix('vehicle_list/')->group(function () {
        Route::get('', [VehicleController::class, 'index']);
        Route::get('get_vehicle', [VehicleController::class, 'get_vehicle']);
        Route::post('allot_vehicle', [VehicleController::class, 'allot_vehicle']);
        Route::get('alloted_list', [VehicleController::class, 'alloted_list']);
        Route::post('add_vehicle', [VehicleController::class, 'add_vehicle']);
        Route::post('show_edit_vehicle', [VehicleController::class, 'show_edit_vehicle']);
        Route::post('update', [VehicleController::class, 'update']);
        Route::post('get_data_with_id', [VehicleController::class, 'get_data_with_id']);
    });

    Route::prefix('settings/')->group(function () {
        Route::get('', [SettingController::class, 'index']);
        Route::post('show_edit', [SettingController::class, 'show_edit']);
        Route::post('update', [SettingController::class, 'update']);
        Route::post('change_password', [SettingController::class, 'change_password']);
    });

    Route::prefix('sale/')->group(function () {
        Route::get('', [SaleController::class, 'index']);
        Route::get('get_data', [SaleController::class, 'get_data']);
        Route::post('add', [SaleController::class, 'add']);
        Route::post('edit', [SaleController::class, 'edit_sale']);
        Route::post('update', [SaleController::class, 'update']);
        Route::post('filterdata', [SaleController::class, 'filterdata']);
        Route::get('export', [SaleController::class, 'export']);
        Route::post('importexcel', [SaleController::class, 'importexcel']);
    });

    Route::prefix('client/')->group(function () {
        Route::get('', [ClientController::class, 'index']);
        Route::get('get_data', [ClientController::class, 'get_data']);
        Route::post('add', [ClientController::class, 'add']);
        Route::post('edit', [ClientController::class, 'edit_client']);
        Route::post('update', [ClientController::class, 'update']);
        Route::post('fetch_data_cl_id', [ClientController::class, 'fetch_data_cl_id']);
    });

    Route::prefix('service_type/')->group(function () {
        Route::get('', [ServicetypeController::class, 'index']);
        Route::get('get_data', [ServicetypeController::class, 'get_data']);
        Route::post('add', [ServicetypeController::class, 'add']);
        Route::post('edit', [ServicetypeController::class, 'edit_ser_type']);
        Route::post('update', [ServicetypeController::class, 'update']);
    });

    Route::prefix('expense_account/')->group(function () {
        Route::get('', [ExpenseController::class, 'index']);
        Route::get('get_data', [ExpenseController::class, 'get_data']);
        Route::post('add', [ExpenseController::class, 'add']);
        Route::post('edit', [ExpenseController::class, 'edit_expense']);
        Route::post('update', [ExpenseController::class, 'update']);
        Route::get('export', [ExpenseController::class, 'export']);
        Route::post('importexcel', [ExpenseController::class, 'importexcel']);
    });
    Route::prefix('cash_report/')->group(function () {
        Route::get('', [CashreportController::class, 'index']);
        Route::get('get_data', [CashreportController::class, 'get_data']);
        Route::post('add', [CashreportController::class, 'add']);
        Route::post('edit', [CashreportController::class, 'edit_cash_report']);
        Route::post('update', [CashreportController::class, 'update']);
        Route::get('export', [CashreportController::class, 'export']);
        Route::post('importexcel', [CashreportController::class, 'importexcel']);
    });

    Route::prefix('filter/')->group(function () {

        Route::post('expense', [FilterController::class, 'expense']);
        Route::post('sale', [FilterController::class, 'sale']);
        Route::post('rental', [FilterController::class, 'rental']);
        Route::post('cash_filter', [FilterController::class, 'cash_filter']);
        Route::post('transport', [FilterController::class, 'transport']);
    });

    Route::prefix('rental_truck/')->group(function () {
        Route::get('', [RentalTruckController::class, 'index']);
        Route::get('get_data', [RentalTruckController::class, 'get_data']);
        Route::post('add', [RentalTruckController::class, 'add']);
        Route::post('edit', [RentalTruckController::class, 'edit_expense']);
        Route::post('update', [RentalTruckController::class, 'update']);
        Route::get('export', [RentalTruckController::class, 'export']);
        Route::post('importexcel', [RentalTruckController::class, 'importexcel']);
        Route::post('get_transporter', [RentalTruckController::class, 'get_transporter']);
    });

    Route::prefix('transport_service/')->group(function () {
        Route::get('', [TransportServiceController::class, 'index']);
        Route::get('get_data', [TransportServiceController::class, 'get_data']);
        Route::post('add', [TransportServiceController::class, 'add']);
        Route::post('edit', [TransportServiceController::class, 'edit']);
        Route::post('update', [TransportServiceController::class, 'update']);
        Route::get('export', [TransportServiceController::class, 'export']);
        Route::post('importexcel', [TransportServiceController::class, 'importexcel']);
        Route::post('get_transporter', [TransportServiceController::class, 'get_transporter']);
    });

    Route::prefix('site/')->group(function () {
        Route::get('', [SiteController::class, 'index']);
        Route::get('get_data', [SiteController::class, 'get_data']);
        Route::post('add', [SiteController::class, 'add']);
        Route::post('edit', [SiteController::class, 'edit_site']);
        Route::post('update', [SiteController::class, 'update']);
        Route::post('get_name', [SiteController::class, 'get_name']);
    });

    Route::prefix('cost_revenue/')->group(function () {
        Route::get('', [ProfitLossController::class, 'index']);
        
    });

    Route::prefix('google_login/')->group(function () {
        Route::get('', [LoginWithGoogleController::class, 'index']);
    });
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});
