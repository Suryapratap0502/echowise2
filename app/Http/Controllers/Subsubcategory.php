<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ServicetypeModel;
use App\Models\SubcategoryModel;
use App\Models\SubsubcatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class Subsubcategory extends Controller
{
    public function index()
    {
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->get();
        return view('product_management/subsubcat_list', $data);
    }

    public function getsubcat_with_cat_id(Request $request)
    {
        $id = $request->id;
        $subcategory = SubcategoryModel::where('cat_id', $id)->get();
        $output = '<option value="0" selected>Select</option>';
        foreach ($subcategory as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['subcategory'] . '</option>';
        }
        $response = array('status' => true, 'output' => $output);
        echo json_encode($response);
    }

    public function getsubsubcat_with_subcat_id(Request $request)
    {
        $id = $request->id; 
        $subcategory = SubsubcatModel::where('sub_cat_id', $id)->get();
        $output = '<option value="0" selected>Select</option>';
        foreach ($subcategory as $value) {
            $output .= '<option value="' . $value['id'] . '">' . $value['subsubcategory'] . '</option>';
        }
        $response = array('status' => true, 'output' => $output);
        echo json_encode($response);
    }

    public function fetch_subsubcat()
    {
        
        $data['subsubcat'] = SubsubcatModel::with('category', 'subcategory','service_type_1')->where('flag', '!=', '2')->get();
        return view('product_management/subsubcat_list_ajax', $data);
    }

    public function add_sub_subcategory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = SubsubcatModel::where('subsubcategory', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Sub Category Already Exist']);
            } else {
                $data['cat_id'] = $request->cat_id;
                $data['service_type'] = $request->service_type;
                $data['sub_cat_id'] = $request->sub_cat_id;
                $data['subsubcategory'] = $request->name;
                if (!empty($request->file('image'))) {
                    $file = $request->file('image');
                    date_default_timezone_set('Asia/Kolkata');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/subsubcategory'), $filename);
                    $data['subsubcat_image'] = $filename;
                }

                $insert_data = SubsubcatModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Sub Sub Category Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_subsubcategory(Request $request)
    {
        $id = $request->id;
        $data['fetch_subsubcat_data'] = SubsubcatModel::where('id', $id)->first();
        $data['category'] = CategoryModel::all();
        $data['subcategory'] = SubcategoryModel::all();
        return view('product_management/subsubcategory_edit', $data);
    }

    public function update_sub_subcategory(Request $request)
    {
        $id = $request->id;
        $data['cat_id'] = $request->cat_id;
        $data['sub_cat_id'] = $request->sub_cat_id;
        $data['subsubcategory'] = $request->name;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/subsubcategory'), $filename);
            $data['subsubcat_image'] = $filename;
        }
        $update_data = SubsubcatModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Sub Category Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function delete_sub_subcat(Request $request)
    {
        $id = $request->id;
        $data['flag'] = '2';
        $delete_data = SubsubcatModel::where('id', $id)->update($data);
        if ($delete_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Sub Category Deleted']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function update_status_sub_subcategory(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if ($status == 'Inactive') {
            $data['flag'] = '1';
        } else {
            $data['flag'] = '0';
        }
        $update_status_data = SubsubcatModel::where('id', $id)->update($data);
        if ($update_status_data) {
            return response()->json(['code' => 200, 'message' => 'Sub Category Status Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
