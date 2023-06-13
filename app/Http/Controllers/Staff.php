<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\RoleModel;
use App\Models\SidebarModel;
use App\Models\StaffModel;
use App\Models\UserAccessModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Staff extends Controller
{
    public function user_list(Request $request)
    {
        $data['roles'] = RoleModel::where('id', '!=', '1')->get();
        $data['user_data'] = StaffModel::with('roles')->where('id', '!=', '1')->where('flag', '!=', '2')->get()->unique('role_id');;
        $data['modulelistdetails'] = SidebarModel::all();
        return view('access_management/subadmin_list', $data);
    }

    public function fetch_all_user()
    {
        $data['user_data'] = StaffModel::with('roles', 'access')->where('id', '!=', '1')->where('flag', '!=', '2')->get();
        return view('access_management/user_list_ajax', $data);
    }

    public function add_user(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|min:10',
            'password' => 'required|min:6',
            'contact' => 'required|max:10|min:10',
            'role' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $email = $request->email;

            $check = AdminModel::where('email', $email)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Email Already Exist']);
            } else {
                $data['name'] = $request->name;
                $data['email'] = $email;
                $data['password'] = Hash::make($request->password);
                $data['mobile_no'] = $request->contact;
                $data['role_id'] = $request->role;
                $sidebar_name   = $request->sidebar_name;

                if (!empty($request->file('image'))) {
                    $file = $request->file('image');
                    date_default_timezone_set('Asia/Kolkata');

                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/staff'), $filename);
                    $data['staff_image'] = $filename;
                }

                $insert_data = AdminModel::insertGetId($data);
                // Module Access Add Start
                $i = 0;

                $read = $request->read;
                $write = $request->write;
                $sidebar_inner_read_id = $request->sidebar_inner_read_id;
                $sidebar_inner_write_id = $request->sidebar_inner_write_id;

                if (!empty($read)) {
                    $savedata = [];
                    $savedata['user_id'] = $insert_data;

                    for ($i = 0; $i < count($read); $i++) {
                        if (!empty($read[$i])) {
                            $savedata['nav_id'] = $read[$i];
                            $savedata['menu'] = 'main';
                            $savedata['read_per'] = 1;
                        }

                        if (!empty($write[$i])) {
                            $savedata['nav_id'] = $write[$i];
                            $savedata['menu'] = 'main';
                            $savedata['write_per'] = 1;
                        }

                        UserAccessModel::insert($savedata);
                    }
                }

                if (!empty($sidebar_inner_read_id)) {
                    $savedata = [];
                    $savedata['user_id'] = $insert_data;

                    for ($i = 0; $i < count($sidebar_inner_read_id); $i++) {
                        if (!empty($sidebar_inner_read_id[$i])) {
                            $savedata['nav_id'] = $sidebar_inner_read_id[$i];
                            $savedata['menu'] = 'inner';
                            $savedata['read_per'] = 1;
                        }

                        if (!empty($sidebar_inner_write_id[$i])) {
                            $savedata['nav_id'] = $sidebar_inner_write_id[$i];
                            $savedata['menu'] = 'inner';
                            $savedata['write_per'] = 1;
                        }

                        UserAccessModel::insert($savedata);
                    }
                }

                // Module Access Add End
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'New User Added']);
                } else {
                    return response()->json(['code' => 404, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_user(Request $request)
    {
        $id = $request->id;
        $data['fetch_user_data'] = StaffModel::where('id', $id)->first();
        $data['roles'] = RoleModel::where('id', '!=', '1')->get();
        return view('access_management/user_edit', $data);
    }

    public function update_user(Request $request)
    {
        $id = $request->user_id;
        $data['name'] = $request->name;
        $data['mobile_no'] = $request->contact;
        $data['role_id'] = $request->role;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/staff'), $filename);
            $data['staff_image'] = $filename;
        }
        $update_data = AdminModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'User Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function delete_user(Request $request)
    {
        $id = $request->id;
        $data['flag'] = '2';
        $delete_data = AdminModel::where('id', $id)->update($data);
        if ($delete_data) {
            return response()->json(['code' => 200, 'message' => 'Account Deleted']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function update_status_user(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if ($status == 'Inactive') {
            $data['flag'] = '1';
        } else {
            $data['flag'] = '0';
        }
        $update_status_data = AdminModel::where('id', $id)->update($data);
        if ($update_status_data) {
            return response()->json(['code' => 200, 'message' => 'Account Status Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function filter_user_data(Request $request)
    {
        $id = $request->id;
        $data['user_data'] = StaffModel::with('roles')->where('role_id', $id)->where('flag', '!=', '2')->get();
        return view('access_management/user_list_ajax', $data);
    }

    public function filter_user_all_data()
    {
        $data['user_data'] = StaffModel::with('roles')->where('flag', '!=', '2')->where('role_id', '!=', '1')->get();
        return view('access_management/user_list_ajax', $data);
    }

    public function get_access(Request $request)
    {
        $id = $request->id;
        $data['user_data'] = StaffModel::with('roles', 'access')->where('id', $id)->where('flag', '!=', '2')->first();
        $access = UserAccessModel::where('user_id', $id)->get();
        $modules = array();
        if (!empty($access)) {
            foreach ($access as $value) {
                array_push($modules, array(
                    'user_id' => $value->user_id,
                    'menu' => $value->menu,
                    'nav_id' => $value->nav_id,
                    'module' => $value->nav_id,
                    'read_per' => $value->read_per,
                    'write_per' => $value->write_per
                ));
            }
        }
        $data['access'] = $modules;
        $data['modules'] = SidebarModel::all();
        return view('access_management/user_access', $data);
    }

    public function change_password(Request $request)
    {
        $data['id'] = $request->id;
        return view('access_management/change_password', $data);
    }
    public function update_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'new_password' => 'required',
            'confirm_pass' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            if ($request->new_password == $request->confirm_pass) {
                $data['password'] = Hash::make($request->new_password);
                $update_data = AdminModel::where('id', $request->user_id)->update($data);
                if ($update_data) {
                    return response()->json(['code' => 200, 'message' => 'Password Updated']);
                } else {
                    return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
                }
            } else {
                return response()->json(['code' => 400, 'message' => 'New Password must be same as Confirm Password']);
            }
        }
    }
}
