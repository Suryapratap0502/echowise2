<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use App\Models\CashreportModel;
use App\Models\RentaltruckModel;
use App\Models\SalesModel;
use App\Models\TransportServiceModel;

class FilterController extends Controller
{
    public function expense(Request $request)
    {
        $start = $request->startdate;
        $enddate = $request->enddate;
        $itemname = $request->itemname;

        $data['expense'] =  ExpenseModel::whereDate('date_of_payment', '>=', "$start")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();

        if (!empty($enddate) && !empty($start)) {
            $data['expense'] = $data['expense']->whereBetween('date_of_payment', ["$start", "$enddate",]);
        }
        if (!empty($itemname)) {
            $data['expense'] = $data['expense']->where('client_id', "$itemname");
        }
        return view('expense/list_ajax', $data);
    }

    public function sale(Request $request)
    {
        $start = $request->startdate;
        $enddate = $request->enddate;
        $itemname = $request->itemname;

        $data['sale_data'] =  SalesModel::whereDate('payment_date', '>=', "$start")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();

        if (!empty($enddate) && !empty($start)) {
            $data['sale_data'] = $data['sale_data']->whereBetween('payment_date', ["$start", "$enddate",]);
        }

        if (!empty($itemname)) {
            $data['sale_data'] = $data['sale_data']->where('item_names', $itemname);
        }
        return view('sale/list_ajax', $data);
    }

    public function cash_filter(Request $request)
    {
        $start = $request->startdate;
        $enddate = $request->enddate;
        $itemname = $request->itemname;
        $data['cash_report'] =  CashreportModel::whereDate('date', '>=', "$start")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        
        if (!empty($enddate) && !empty($start)) {
            $data['cash_report'] = $data['cash_report']->whereBetween('date', ["$start", "$enddate",]);
        }

        if (!empty($itemname)) {
            $data['cash_report'] = $data['cash_report']->where('data_status', $itemname);
        }
        return view('cashreport/list_ajax', $data);
    }  
    
    public function rental(Request $request)
    {
        $start = $request->startdate;
        $enddate = $request->enddate;
        $itemname = $request->itemname;
        $data['rental'] =  RentaltruckModel::whereDate('loading_date', '>=', "$start")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        
        if (!empty($enddate) && !empty($start)) {
            $data['rental'] = $data['rental']->whereBetween('loading_date', ["$start", "$enddate",]);
        }

        if (!empty($itemname)) {
            $data['rental'] = $data['rental']->where('site', $itemname);
        }
        return view('rental_truck/list_ajax', $data);
    } 
    
    public function transport(Request $request)
    {
        $start = $request->startdate;
        $enddate = $request->enddate;
        $itemname = $request->itemname;
        $data['transport_service'] =  TransportServiceModel::whereDate('booking_date', '>=', "$start")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        
        if (!empty($enddate) && !empty($start)) {
            $data['transport_service'] = $data['transport_service']->whereBetween('booking_date', ["$start", "$enddate",]);
        }

        if (!empty($itemname)) {
            $data['transport_service'] = $data['transport_service']->where('driver_name', $itemname);
        }
        return view('transport_service/list_ajax', $data);
    } 
}
