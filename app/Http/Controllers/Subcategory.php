<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ServicetypeModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class Subcategory extends Controller
{
    public function index()
    {
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->get();
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        $data['subcategory'] = SubcategoryModel::with('category')->where('flag', '!=', '2')->get();
        return view('product_management/subcat_list', $data);
    }

    public function fetch_subcat()
    {
        $data['subcategory'] = SubcategoryModel::with('category','service_type_1')->where('flag', '!=', '2')->get();
        return view('product_management/subcat_list_ajax', $data);
    }

    public function add_subcategory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'cat_id' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = SubcategoryModel::where('subcategory', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Sub Category Already Exist']);
            } else {
                $data['cat_id'] = $request->cat_id;
                $data['service_type'] = $request->service_type;
                $data['subcategory'] = $request->name;
                if (!empty($request->file('image'))) {
                    $file = $request->file('image');
                    date_default_timezone_set('Asia/Kolkata');

                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/subcategory'), $filename);
                    $data['subcat_image'] = $filename;
                }

                $insert_data = SubcategoryModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Sub Category Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_subcategory(Request $request)
    {
        $id = $request->id;
        $data['fetch_subcat_data'] = SubcategoryModel::where('id', $id)->first();
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        return view('product_management/subcategory_edit', $data);
    }

    public function update_subcategory(Request $request)
    {
        $id = $request->id;
        $data['cat_id'] = $request->cat_id;
        $data['subcategory'] = $request->name;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/subcategory'), $filename);
            $data['subcat_image'] = $filename;
        }
        $update_data = SubcategoryModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Category Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function update_status_subcategory(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if ($status == 'Inactive') {
            $data['flag'] = '1';
        } else {
            $data['flag'] = '0';
        }
        $update_status_data = SubcategoryModel::where('id', $id)->update($data);
        if ($update_status_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Category Status Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function delete_subcat(Request $request)
    {
        $id = $request->id;
        $data['flag'] = '2';
        $delete_data = SubcategoryModel::where('id', $id)->update($data);
        if ($delete_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Category Deleted']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function get_cat_with_service_type(Request $request)
    {
        $id = $request->id;
        $service_type = CategoryModel::where('service_type', $id)->get();
        $output = '<option value="0" selected>Select</option>';
        foreach ($service_type as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['category'] . '</option>';
        }
        $response = array('status' => true, 'output' => $output);
        echo json_encode($response);
    }
}
