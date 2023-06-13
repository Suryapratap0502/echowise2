<?php

namespace App\Http\Controllers;

use App\Models\CashmanagementModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CashmanagementController extends Controller
{
    public function index()
    {
        return view('cash_management/list');
    }

    public function fetch_pay_list()
    {
        $data['cash_management'] = CashmanagementModel::where('flag', '!=', '2')->get();
        return view('cash_management/list_ajax', $data);
    }

    public function add_pay_method(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required'

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = CashmanagementModel::where('pay_method', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Payment Method Already Exist']);
            } else {
                $data['pay_method'] = $name;
                $insert_data = CashmanagementModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Payment Method Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_pay_method(Request $request)
    {
        $id = $request->id;
        $data['fetch_pay_method'] = CashmanagementModel::where('id', $id)->first();
        return view('cash_management/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['pay_method'] = $request->name;
        $update_data = CashmanagementModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Payment Method Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
