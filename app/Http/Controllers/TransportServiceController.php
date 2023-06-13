<?php

namespace App\Http\Controllers;

use App\Exports\ExportTranspotation;
use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\SiteModel;
use App\Models\TransportServiceModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class TransportServiceController extends Controller
{
    public function index()
    {
        // $data['client'] = ClientModel::where('flag', '!=', '2')->get();
        $data['vehicle'] = VehicleModel::where('flag', '!=', '2')->get();
        $data['driver'] = AdminModel::where('flag', '!=', '2')->where('role_id', '6')->get();
        $data['site'] = SiteModel::where('flag', '!=', '2')->get();
        $data['exist_driver'] = TransportServiceModel::with('admin')->where('flag', '!=', '2')->distinct()->get(['driver_name']);
        return view('transport_service/list', $data);
    }

    public function get_data()
    {
        $data['transport_service'] = TransportServiceModel::with('admin', 'vehicle_data', 'site_1')->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        return view('transport_service/list_ajax', $data);
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'booking_date' => 'required',
            'start_trip' => 'required',
            'vehicle_no' => 'required',
            'vehicle_size' => 'required',
            'vehicle_capacity' => 'required',
            'start_destination' => 'required',
            'start_load_destination' => 'required',
            'final_destination' => 'required',
            'distance' => 'required',
            'end_trip' => 'required',
            'duration_day' => 'required',
            'driver_name' => 'required',
            'fuel_qty' => 'required',
            'fuel_price' => 'required',
            'toll' => 'required',
            'cash_toll' => 'required',
            'worker_expense' => 'required',

            'police' => 'required',
            'ad_blue' => 'required',
            'vehicle_repair' => 'required',
            'dala' => 'required',
            'border' => 'required',
            'border_weight' => 'required',
            'bilti' => 'required',
            'union_youth' => 'required',
            'rto' => 'required',
            'misc' => 'required',
            'total_exp_paid' => 'required',
            'vehicle_booking_amt' => 'required',
            'vehicle_pay_recv' => 'required',
            'commission' => 'required',
            'munsiyana' => 'required',
            'tds' => 'required',
            'holding_charges' => 'required',

            'profit_loss' => 'required',
            'due_on_logistics' => 'required',
            'pan' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {

            for ($y = 0; $y < count($request->booking_date); ++$y) {

                $data['booking_date'] = $request->booking_date[$y];
                $data['start_trip'] = $request->start_trip[$y];
                $data['vehicle_no'] = $request->vehicle_no[$y];
                $data['vehicle_size'] = $request->vehicle_size[$y];
                $data['vehicle_capacity'] = $request->vehicle_capacity[$y];
                $data['start_destination'] = $request->start_destination[$y];
                $data['start_load_destination'] = $request->start_load_destination[$y];
                $data['final_destination'] = $request->final_destination[$y];
                $data['distance'] = $request->distance[$y];
                $data['end_trip'] = $request->end_trip[$y];
                $data['duration_day'] = $request->duration_day[$y];
                $data['driver_name'] = $request->driver_name[$y];
                $data['fuel_qty'] = $request->fuel_qty[$y];
                $data['fuel_price'] = $request->fuel_price[$y];
                $data['toll'] = $request->toll[$y];
                $data['cash_toll'] = $request->cash_toll[$y];
                $data['worker_expense'] = $request->worker_expense[$y];

                $data['police'] = $request->police[$y];
                $data['ad_blue'] = $request->ad_blue[$y];
                $data['vehicle_repair'] = $request->vehicle_repair[$y];
                $data['dala'] = $request->dala[$y];
                $data['border'] = $request->border[$y];
                $data['border_weight'] = $request->border_weight[$y];
                $data['bilti'] = $request->bilti[$y];
                $data['union_youth'] = $request->union_youth[$y];
                $data['rto'] = $request->rto[$y];
                $data['misc'] = $request->misc[$y];
                $data['total_exp_paid'] = $request->total_exp_paid[$y];
                $data['vehicle_booking_amt'] = $request->vehicle_booking_amt[$y];
                $data['vehicle_pay_recv'] = $request->vehicle_pay_recv[$y];
                $data['commission'] = $request->commission[$y];
                $data['munsiyana'] = $request->munsiyana[$y];
                $data['tds'] = $request->tds[$y];
                $data['holding_charges'] = $request->holding_charges[$y];
                $data['profit_loss'] = $request->profit_loss[$y];
                $data['due_on_logistics'] = $request->due_on_logistics[$y];
                $data['pan'] = $request->pan[$y];
                $insert_data = TransportServiceModel::insert($data);
            }
            if ($insert_data) {
                return response()->json(['code' => 200, 'message' => 'Transport Data Added']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data['vehicle'] = VehicleModel::where('flag', '!=', '2')->get();
        $data['driver'] = AdminModel::where('flag', '!=', '2')->where('role_id', '6')->get();
        $data['site'] = SiteModel::where('flag', '!=', '2')->get();
        $data['transport'] = TransportServiceModel::where('id', $id)->first();
        return view('transport_service/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['booking_date'] = $request->booking_date;
        $data['start_trip'] = $request->start_trip;
        $data['vehicle_no'] = $request->vehicle_no;
        $data['vehicle_size'] = $request->vehicle_size;
        $data['vehicle_capacity'] = $request->vehicle_capacity;
        $data['start_destination'] = $request->start_destination;
        $data['start_load_destination'] = $request->start_load_destination;
        $data['final_destination'] = $request->final_destination;
        $data['distance'] = $request->distance;
        $data['end_trip'] = $request->end_trip;
        $data['duration_day'] = $request->duration_day;
        $data['driver_name'] = $request->driver_name;
        $data['fuel_qty'] = $request->fuel_qty;
        $data['fuel_price'] = $request->fuel_price;
        $data['toll'] = $request->toll;
        $data['cash_toll'] = $request->cash_toll;
        $data['worker_expense'] = $request->worker_expense;

        $data['police'] = $request->police;
        $data['ad_blue'] = $request->ad_blue;
        $data['vehicle_repair'] = $request->vehicle_repair;
        $data['dala'] = $request->dala;
        $data['border'] = $request->border;
        $data['border_weight'] = $request->border_weight;
        $data['bilti'] = $request->bilti;
        $data['union_youth'] = $request->union_youth;
        $data['rto'] = $request->rto;
        $data['misc'] = $request->misc;
        $data['total_exp_paid'] = $request->total_exp_paid;
        $data['vehicle_booking_amt'] = $request->vehicle_booking_amt;
        $data['vehicle_pay_recv'] = $request->vehicle_pay_recv;
        $data['commission'] = $request->commission;
        $data['munsiyana'] = $request->munsiyana;
        $data['tds'] = $request->tds;
        $data['holding_charges'] = $request->holding_charges;
        $data['profit_loss'] = $request->profit_loss;
        $data['due_on_logistics'] = $request->due_on_logistics;
        $data['pan'] = $request->pan;
        $update_data = TransportServiceModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Transpotation Data Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function export()
    {
        $arr = array();
        $transpotation_service = TransportServiceModel::where('flag', '!=', '2')->get();

        array_push($arr, array(
            'S. No.',
            'Booking Date',
            'Start Trip',
            'Truck Number',
            'Size of Truck',
            'Capacity (Ton)',
            'Starting Destination',
            'Starting Load Destination',
            'Final Destination',
            'Distance (KM)',
            'End Trip',
            'Duration (Days)',
            'Driver Name',
            'Diesel liters/ CNG (KG)',
            'Diesel/CNG Rupees',
            'Toll',
            'Cash Toll',
            'Driver/ Helper Expense',
            'Police',
            'Ad Blue',
            'Vehicle repair',
            'Dala',
            'Border',
            'Border Weight',
            'Bilti',
            'Union',
            'RTO',
            'Misc',
            'Total expenses (Paid)',
            'Truck booking amount',
            'Truck payment received',
            'Commission',
            'Munsiyana',
            'TDS',
            'HoldingCharges',
            'Profit/ Loss',
            'Due on logistics',
            'Pan',

        ));

        if (!empty($transpotation_service)) {
            foreach ($transpotation_service as $key => $value) {
                $vehicle_no = VehicleModel::where('id', $value->vehicle_no)->first();
                $site_name = SiteModel::where('id', $value->start_destination)->first();
                $driver_name = AdminModel::where('id', $value->driver_name)->first();
                array_push($arr, array(
                    'S. No.' => $key + 1,
                    'Booking Date' => $value->booking_date ?? '',
                    'Start Trip' => $value->start_trip ?? '',
                    'Truck Number' => $vehicle_no->vehicle_number ?? '',
                    'Size of Truck' => $value->vehicle_size ?? '',
                    'Capacity (Ton)' => $value->vehicle_capacity ?? '',
                    'Starting Destination' => $site_name->name .'('.$site_name->location.')' ?? '',
                    'Starting Load Destination' => $value->start_load_destination ?? '',
                    'Final Destination' => $value->final_destination ?? '',
                    'Distance (KM)' => $value->distance ?? '',
                    'End Trip' => $value->end_trip ?? '',
                    'Duration (Days)' => $value->duration_day ?? '',
                    'Driver Name' => $driver_name->name .'('.$driver_name->mobile_no.')' ?? '',
                    'Diesel liters/ CNG (KG)' => $value->fuel_qty ?? '',
                    'Diesel/CNG Rupees' => $value->fuel_price ?? '',
                    'Toll' => $value->toll ?? '',
                    'Cash Toll' => $value->cash_toll ?? '',
                    'Driver/ Helper Expense' => $value->worker_expense ?? '',
                    'Police' => $value->police ?? '',
                    'Ad Blue' => $value->ad_blue ?? '',
                    'Vehicle repair' => $value->vehicle_repair ?? '',
                    'Dala' => $value->dala ?? '',
                    'Border' => $value->border ?? '',
                    'Border Weight' => $value->border_weight ?? '',
                    'Bilti' => $value->bilti ?? '',
                    'Union' => $value->union_youth ?? '',
                    'RTO' => $value->rto ?? '',
                    'Misc' => $value->misc ?? '',
                    'Total expenses (Paid)' => $value->total_exp_paid ?? '',
                    'Truck booking amount' => $value->vehicle_booking_amt ?? '',
                    'Truck payment received' => $value->vehicle_pay_recv ?? '',
                    'Commission' => $value->commission ?? '',
                    'Munsiyana' => $value->munsiyana ?? '',
                    'TDS' => $value->tds ?? '',
                    'HoldingCharges' => $value->holding_charges ?? '',
                    'Profit/ Loss' => $value->profit_loss ?? '',
                    'Due on logistics' => $value->due_on_logistics ?? '',
                    'Pan' => $value->pan ?? ''

                ));
            }
        }

        return Excel::download(new ExportTranspotation($arr), 'transpotation_services.xlsx');
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
                        $get_vehicle_id = VehicleModel::where('vehicle_number', $row[2])->first();
                        $driver_name = explode('(', $row[11]);
                        $driver_mobile = str_replace(')', '', $driver_name[1]);
                        $get_driver_mobile = AdminModel::where('mobile_no', $driver_mobile)->first();

                        $start_destination = explode('(', $row[5]);
                        $site_location = str_replace(')', '', $start_destination[1]);
                        $site_name = $start_destination[0];
                        $get_site_id = SiteModel::where('name', $site_name)->where('location', $site_location)->first();
                        $get_driver_id = AdminModel::where('mobile_no', $driver_mobile)->where('name', $driver_name)->first();
                        if (!empty($get_vehicle_id) && !empty($get_driver_mobile && !empty($get_site_id))) {
                            array_push($savedata, array('booking_date' => $row[0] ?? '', 'start_trip' => $row[1] ?? '', 'vehicle_no' => $get_vehicle_id->id ?? '', 'vehicle_size' => $row[3] ?? '', 'vehicle_capacity' => $row[4] ?? '', 'start_destination' => $get_site_id->id ?? '', 'start_load_destination' => $row[6] ?? '', 'final_destination' => $row[7] ?? '', 'distance' => $row[8] ?? '', 'end_trip' => $row[9] ?? '', 'duration_day' => $row[10] ?? '', 'driver_name' => $get_driver_id->id ?? '', 'fuel_qty' => $row[12] ?? '', 'fuel_price' => $row[13] ?? '', 'toll' => $row[14] ?? '', 'cash_toll' => $row[15] ?? '', 'worker_expense' => $row[16] ?? '', 'police' => $row[17] ?? '', 'ad_blue' => $row[18] ?? '', 'vehicle_repair' => $row[19] ?? '', 'dala' => $row[20] ?? '', 'border' => $row[21] ?? '', 'border_weight' => $row[22] ?? '', 'bilti' => $row[23] ?? '', 'union_youth' => $row[24] ?? '', 'rto' => $row[25] ?? '', 'misc' => $row[26] ?? '', 'total_exp_paid' => $row[27] ?? '', 'vehicle_booking_amt' => $row[28] ?? '', 'vehicle_pay_recv' => $row[29] ?? '', 'commission' => $row[30] ?? '', 'munsiyana' => $row[31] ?? '', 'tds' => $row[32] ?? '', 'holding_charges' => $row[33] ?? '', 'profit_loss' => $row[34] ?? '', 'due_on_logistics' => $row[35] ?? '', 'pan' => $row[36] ?? ''));
                        } else {
                            return response()->json(['code' => 400, 'message' =>  'Check Vehicle or Driver Mobile in Line No. ' . $next_key . '']);
                        }
                    }
                }
            }

            if (!empty($savedata)) {
                $saved = TransportServiceModel::insert($savedata);
            }
        }

        if (!empty($saved)) {
            return response()->json(['code' => 200, 'message' =>  'Imported successfully']);
        } else {
            return response()->json(['code' => 400, 'message' =>  'Something went wrong']);
        }
    }
}
