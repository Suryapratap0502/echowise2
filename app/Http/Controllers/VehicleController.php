<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\VehicleAllotmentModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicle/list');
    }

    public function get_vehicle()
    {
        $data['vehicle'] = VehicleModel::with(['allot_driver' => function ($query) {
            $query->where('flag', '1')->first();
        }])->where('flag', '!=', '2')->get();   
        $data['driver'] = AdminModel::where('flag', '!=', '2')->where('role_id', '6')->get();
        return view('vehicle/list_ajax', $data);
    }

    public function add_vehicle(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'vehicle_number' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->vehicle_number;

            $check = VehicleModel::where('vehicle_number', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Vehicle Number Already Exist']);
            } else {
                $data['vehicle_number'] = $request->vehicle_number;
                $data['vehicle_type'] = $request->vehicle_type;
                $data['capacity'] = $request->capacity;
                $data['size'] = $request->size;
                $insert_data = VehicleModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Vehicle Added']);
                } else {
                    return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }


    public function show_edit_vehicle(Request $request)
    {
        $id = $request->id;
        $data['vehicle'] = VehicleModel::where('id', $id)->first();
        return view('vehicle/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['vehicle_number'] = $request->vehicle_number;
        $data['vehicle_type'] = $request->vehicle_type;
        $data['capacity'] = $request->capacity;
        $data['size'] = $request->size;
        $update_data = VehicleModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Vehicle Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function allot_vehicle(Request $request)
    {
        if ($request->id != 'allotment_remove') {
            $data['vehicle_id'] = $request->v_id;
            $data['vehicle_number'] = $request->v_no;
            $data['driver_id'] = $request->id;
            $check = VehicleAllotmentModel::where('vehicle_id', $request->v_id)->where('driver_id', $request->id)->first();
            if ($check) {
                $data['flag'] = '1';
                $insert_data = VehicleAllotmentModel::where('vehicle_id', $request->v_id)->update($data);
            } else {
                $data2['flag'] = '2';
                $insert_data = VehicleAllotmentModel::where('vehicle_id', $request->v_id)->update($data2);
                $data['flag'] = '1';
                $insert_data = VehicleAllotmentModel::insert($data);
            }
            if ($insert_data) {
                return response()->json(['code' => 200, 'message' => 'Vehicle Allotted']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
            }
        } else {
            $data['flag'] = '2';
            $update_data = VehicleAllotmentModel::where('vehicle_id', $request->v_id)->update($data);
            if ($update_data) {
                return response()->json(['code' => 200, 'message' => 'Vehicle Deallocated']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function alloted_list()
    {
        $data['vehicle'] = VehicleAllotmentModel::with('admin','vehicle')->get();
        return view('vehicle/alloted_list', $data);
    }

    public function get_data_with_id(Request $request)
    {
        $id = $request->id;
        $vehicle_data = VehicleModel::where('id', $id)->first();
        return response()->json(['size' => $vehicle_data->size, 'capacity' => $vehicle_data->capacity]);
    }
}
