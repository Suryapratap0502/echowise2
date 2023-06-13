<?php

namespace App\Http\Controllers;

use App\Exports\ExportExpense;
use App\Exports\ExportRental;
use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\RentaltruckModel;
use App\Models\SiteModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RentalTruckController extends Controller
{
    public function index()
    {
        $data['client'] = ClientModel::where('flag', '!=', '2')->get();
        $data['vehicle'] = VehicleModel::where('flag', '!=', '2')->get();
        $data['site'] = SiteModel::where('flag', '!=', '2')->get();
        $data['exist_site'] = RentaltruckModel::with('site_1')->where('flag', '!=', '2')->distinct()->get(['site']);
        return view('rental_truck/list', $data);
    }
    public function get_data()
    {
        $data['rental'] = RentaltruckModel::with('clients', 'site_1', 'vehicle')->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        return view('rental_truck/list_ajax', $data);
    }
    public function get_transporter()
    {
        $exist_transporter = RentaltruckModel::where('flag', '!=', '2')->groupBy('transporter_name')->pluck('transporter_name');
        return $exist_transporter;
    }
    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'loading_date' => 'required',
            'location' => 'required',
            'client_id' => 'required',
            'vehicle_no' => 'required',
            'lab_loading_overloading' => 'required',
            'booking_amt' => 'required',
            'adv_pay' => 'required',
            'adv_pay_date' => 'required',
            'final_pay' => 'required',
            'final_pay_date' => 'required',
            'unloading_date' => 'required',
            'weight_cl_site' => 'required',
            'site' => 'required',
            'weight_sel_site' => 'required',
            'weight_differ' => 'required',
            'transporter' => 'required',
            'pan' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            for ($y = 0; $y < count($request->loading_date); ++$y) {

                $data['loading_date'] = $request->loading_date[$y];
                $data['location'] = $request->location[$y];
                $data['client'] = $request->client_id[$y];
                $data['vehicle_no'] = $request->vehicle_no[$y];
                $data['loading_exp_over_loading'] = $request->lab_loading_overloading[$y];
                $data['booking_amt'] = $request->booking_amt[$y];
                $data['adv_pay'] = $request->adv_pay[$y];
                $data['final_pay_truck'] = $request->final_pay[$y];
                $data['adv_pay_date'] = $request->adv_pay_date[$y];
                $data['final_pay_date'] = $request->final_pay_date[$y];
                $data['unloading_date'] = $request->unloading_date[$y];
                $data['client_site_weight'] = $request->weight_cl_site[$y];
                $data['site'] = $request->site[$y];
                $data['site_weight'] = $request->weight_sel_site[$y];
                $data['weight_differ'] = $request->weight_differ[$y];
                $data['transporter_name'] = $request->transporter[$y];
                $data['pan'] = $request->pan[$y];
                $insert_data = RentaltruckModel::insert($data);
            }
            if ($insert_data) {
                return response()->json(['code' => 200, 'message' => 'Rental Truck Added']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function edit_expense(Request $request)
    {
        $id = $request->id;
        $data['client'] = ClientModel::where('flag', '!=', '2')->get();
        $data['vehicle'] = VehicleModel::where('flag', '!=', '2')->get();
        $data['site'] = SiteModel::where('flag', '!=', '2')->get();
        $data['rental'] = RentaltruckModel::where('id', $id)->first();
        return view('rental_truck/edit', $data);
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data['loading_date'] = $request->loading_date;
        $data['location'] = $request->location;
        $data['client'] = $request->client_id;
        $data['vehicle_no'] = $request->vehicle_no;
        $data['loading_exp_over_loading'] = $request->lab_loading_overloading;
        $data['booking_amt'] = $request->booking_amt;
        $data['adv_pay'] = $request->adv_pay;
        $data['final_pay_truck'] = $request->final_pay;
        $data['adv_pay_date'] = $request->adv_pay_date;
        $data['final_pay_date'] = $request->final_pay_date;
        $data['unloading_date'] = $request->unloading_date;
        $data['client_site_weight'] = $request->weight_cl_site;
        $data['site'] = $request->site;
        $data['site_weight'] = $request->weight_sel_site;
        $data['weight_differ'] = $request->weight_differ;
        $data['transporter_name'] = $request->transporter;
        $data['pan'] = $request->pan;
        $update_data = RentaltruckModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Rental Truck Data Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function export()
    {
        $arr = array();
        $rental_truck_report = RentaltruckModel::where('flag', '!=', '2')->get();

        array_push($arr, array(
            'S. No.',
            'Loading Date',
            'Location',
            'Client Name',
            'Vehicle No.',
            'Labour Loading Expenses/Over loading',
            'Booking Amount',
            'Advance payment for Rental Trucks',
            'Advance payment Date',
            'Final Payment for Rental Trucks',
            'Final Payment Date',
            'Unloading Date',
            'Weight at Client Site (Kg)',
            'Site',
            'Weight at Site Kg',
            'Weight Difference',
            'Transporter Name',
            'PAN',
            'Added Date'

        ));

        if (!empty($rental_truck_report)) {
            foreach ($rental_truck_report as $key => $value) {
                $cl_name = ClientModel::where('id', $value->client)->first();
                $vehicle_no = VehicleModel::where('id', $value->vehicle_no)->first();
                $site_name = SiteModel::where('id', $value->site)->first();
                array_push($arr, array(
                    'S. No.' => $key + 1,
                    'Loading Date' => $value->loading_date ?? '',
                    'Location' => $value->location ?? '',
                    'Client Name' => $cl_name->name ?? '',
                    'Vehicle No.' => $vehicle_no->vehicle_number ?? '',
                    'Labour Loading Expenses/Over loading' => $value->loading_exp_over_loading ?? '',
                    'Booking Amount' => $value->booking_amt ?? '',
                    'Advance payment for Rental Trucks' => $value->adv_pay ?? '',
                    'Advance payment Date' => $value->adv_pay_date ?? '',
                    'Final Payment for Rental Trucks' => $value->final_pay_truck ?? '',
                    'Final Payment Date' => $value->final_pay_date ?? '',
                    'Unloading Date' => $value->unloading_date ?? '',
                    'Weight at Client Site (Kg)' => $value->client_site_weight ?? '',
                    'Site' => $site_name->name . ' (' . $site_name->location . ')' ?? '',
                    'Weight at Site Kg' => $value->site_weight ?? '',
                    'Weight Difference' => $value->weight_differ ?? '',
                    'Transporter Name' => $value->transporter_name ?? '',
                    'PAN' => $value->pan ?? '',
                    'Added Date' => $value->created_at ?? ''

                ));
            }
        }

        return Excel::download(new ExportRental($arr), 'rental_truck.xlsx');
    }

    public function importexcel()
    {
        $data = Excel::toArray([], request()->file('uploadFile'));
        $savedata = array();
        if (!empty($data)) {
            foreach ($data[0] as $key => $row) {
                if ($key >= 1) {
                    $next_key = $key + 1;
                    if (!empty($row['0'])) {
                        if (str_contains($row[12], '(')) {
                            $get_cl_id = ClientModel::where('name', $row[2])->first();
                            $get_vehicle_id = VehicleModel::where('vehicle_number', $row[3])->first();
                            $site_name = explode('(', $row[12]);
                            $site_location = str_replace(')', '', $site_name[1]);
                            $get_site_id = SiteModel::where('name', $site_name[0])->where('location', $site_location)->first();
                            array_push($savedata, array('loading_date' => $row[0] ?? '', 'location' => $row[1] ?? '', 'client' => $get_cl_id->id ?? '', 'vehicle_no' => $get_vehicle_id->id ?? '', 'loading_exp_over_loading' => $row[4] ?? '', 'booking_amt' => $row[5] ?? '', 'adv_pay' => $row[6] ?? '', 'adv_pay_date' => $row[7] ?? '', 'final_pay_truck' => $row[8] ?? '', 'final_pay_date' => $row[9] ?? '', 'unloading_date' => $row[10] ?? '', 'client_site_weight' => $row[11] ?? '', 'site' => $get_site_id->id ?? '', 'site_weight' => $row[13] ?? '', 'weight_differ' => $row[14] ?? '', 'transporter_name' => $row[15] ?? '', 'pan' => $row[16] ?? ''));
                        } else {
                            return response()->json(['code' => 400, 'message' =>  'Check Site Name / Add "Site Name (Location)" in Line No. ' . $next_key . '']);
                        }
                    }
                }
            }

            if (!empty($savedata)) {
                $saved = RentaltruckModel::insert($savedata);
            }
        }

        if (!empty($saved)) {
            return response()->json(['code' => 200, 'message' =>  'Imported successfully']);
        } else {
            return response()->json(['code' => 400, 'message' =>  'Something went wrong']);
        }
    }
}
