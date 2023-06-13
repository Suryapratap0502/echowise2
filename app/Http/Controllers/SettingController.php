<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\StaffModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller
{
    public function index()
    {
        $sess_id = session('admin_login');
        $id = $sess_id['id'];
        $data['user_details']  = AdminModel::with('role_name')->where('id', $id)->first();
        return view('setting/general_setting', $data);
    }

    public function show_edit(Request $request)
    {
        $id = $request->id;
        $data['item'] = AdminModel::where('id', $id)->first();
        return view('setting/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['name'] = $request->name;
        $data['mobile_no'] = $request->mobile;
        $update_data = AdminModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Data Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function change_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'new_pass' => 'required',
            'confirm_pass' => 'required',
            'old_pass' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $hidden_id = $request->hidden_id;
            $check_email = AdminModel::where('id', $hidden_id)->first();
            $old_pass = Hash::make($request->old_pass);
            if ($request->new_pass == $request->confirm_pass)
            {
                if ($old_pass == $check_email->password) {
                    $data['password'] = Hash::make($request->new_pass);
                    $update_data = AdminModel::where('id', $request->id)->update($data);
                    if ($update_data) {
                        return response()->json(['code' => 200, 'message' => 'Password Updated']);
                    } else {
                        return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
                    }
                } else {
                    return response()->json(['code' => 402, 'message' => 'Incorrect Old Password']);
                }
        }
        else{
            return response()->json(['code' => 403, 'message' => 'New Password & Confirm Password Should be same']);
        }
    }
}
}
