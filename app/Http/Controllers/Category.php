<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ServicetypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;




class Category extends Controller
{
    public function category_list()
    {
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->get();
        return view('product_management/category_list', $data);
    }

    public function fetch_cat()
    {
        $data['category'] = CategoryModel::with('service_type_1')->where('flag', '!=', '2')->get();
        return view('product_management/cat_list_ajax', $data);
    }

    public function add_category(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'service_type' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = CategoryModel::where('category', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Category Already Exist']);
            } else {
                $data['category'] = $request->name;
                $data['service_type'] = $request->service_type;
                if (!empty($request->file('image'))) {
                    $file = $request->file('image');
                    date_default_timezone_set('Asia/Kolkata');

                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/category'), $filename);
                    $data['cat_image'] = $filename;
                }

                $insert_data = CategoryModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Category Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_category(Request $request)
    {
        $id = $request->id;
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        $data['fetch_cat_data'] = CategoryModel::where('id', $id)->first();
        return view('product_management/category_edit', $data);
    }

    public function update_category(Request $request)
    {
        $id = $request->id;
        $data['category'] = $request->name;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/category'), $filename);
            $data['cat_image'] = $filename;
        }
        $update_data = CategoryModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Category Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function delete_cat(Request $request)
    {
        $id = $request->id;
        $data['flag'] = '2';
        $delete_data = CategoryModel::where('id', $id)->update($data);
        if ($delete_data) {
            return response()->json(['code' => 200, 'message' => 'Category Deleted']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function update_status_category(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($status == 'Inactive')
        {
            $data['flag'] = '1';
        }
        else{
            $data['flag'] = '0';
        }
        $update_status_data = CategoryModel::where('id', $id)->update($data);
        if ($update_status_data) {
            return response()->json(['code' => 200, 'message' => 'Category Status Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }    
}
