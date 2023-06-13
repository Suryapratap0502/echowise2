<?php

namespace App\Http\Controllers;

use App\Models\ServicetypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicetypeController extends Controller
{
    public function index()
    {
        return view('master/service_type/list');
    }
    public function get_data()
    {
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        return view('master/service_type/list_ajax', $data);
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;
            $check = ServicetypeModel::where('name', $name)->first();
            if (!empty($check)) {
                return response()->json(['code' => 402, 'message' => 'Service Type Already Exist']);
            } else {
                $data['name'] = $request->name;
                $insert_data = ServicetypeModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Service Type Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function edit_ser_type(Request $request)
    {
        $id = $request->id;
        $data['ser_type_data'] = ServicetypeModel::where('id', $id)->first();
        return view('master/service_type/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['name'] = $request->name;
        $update_data = ServicetypeModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Service Type Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
