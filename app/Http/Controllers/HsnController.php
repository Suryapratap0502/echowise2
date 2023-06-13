<?php

namespace App\Http\Controllers;

use App\Models\HsnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class HsnController extends Controller
{
    public function index()
    {
        return view('hsn/list');
    }

    public function get_hsn()
    {
        $data['hsn_code'] = HsnModel::where('flag', '!=', '2')->get();
        return view('hsn/hsn_ajax', $data);
    }

    public function add_hsn(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = HsnModel::where('hsn_code', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Code Already Exist']);
            } else {
                $data['hsn_code'] = $request->name;
                $data['description'] = $request->description;
                $insert_data = HsnModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'HSN Code Added']);
                } else {
                    return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_hsn(Request $request)
    {
        $id = $request->id;
        $data['fetch_hsn_data'] = HsnModel::where('id', $id)->first();
        return view('hsn/edit', $data);
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data['hsn_code'] = $request->name;
        $data['description'] = $request->description;
        $update_data = HsnModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'HSN Code Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
