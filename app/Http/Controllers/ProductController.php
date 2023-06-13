<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;
use App\Models\SubsubcatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        $data['code'] = 'ECONATURE'.random_int(100,999);
        return view('product_management/product_list', $data);
    }

    public function get_products()
    {
        $data['product'] = ProductModel::with('category', 'subcategory', 'subsubcategory')->where('flag', '!=', '2')->get();
        return view('product_management/product_list_ajax', $data);
    }

    public function add_products(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'p_name' => 'required',
            'code' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'sub_sub_cat_id' => 'required',
            'hsn' => 'required',
            'p_unit' => 'required',
            'p_size' => 'required',
            'p_quanity' => 'required',
            'image' => 'required',
            'p_desc' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->p_name;

            $check = ProductModel::where('name', $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Product Already Exist']);
            } else {
                $data['cat_id'] = $request->cat_id;
                $data['code'] = $request->code;
                $data['sub_cat_id'] = $request->sub_cat_id;
                $data['sub_sub_cat_id'] = $request->sub_sub_cat_id;
                $data['name'] = $request->p_name;
                $data['hsn'] = $request->hsn;
                $data['unit'] = $request->p_unit;
                $data['size'] = $request->p_size;
                $data['quantity'] = $request->p_quanity;
                $data['description'] = $request->p_desc;
                if (!empty($request->file('image'))) {
                    $file = $request->file('image');
                    date_default_timezone_set('Asia/Kolkata');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/product'), $filename);
                    $data['image'] = $filename;
                }

                $insert_data = ProductModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Product Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function show_edit_product(Request $request)
    {
        $id = $request->id;
        $data['fetch_product_data'] = ProductModel::where('id', $id)->first();
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        $data['subcategory'] = SubcategoryModel::where('flag', '!=', '2')->get();
        $data['subsubcategory'] = SubsubcatModel::where('flag', '!=', '2')->get();
        return view('product_management/product_edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['cat_id'] = $request->cat_id;
        $data['code'] = $request->code;
        $data['sub_cat_id'] = $request->sub_cat_id;
        $data['sub_sub_cat_id'] = $request->sub_sub_cat_id;
        $data['name'] = $request->p_name;
        $data['hsn'] = $request->hsn;
        $data['unit'] = $request->p_unit;
        $data['size'] = $request->p_size;
        $data['quantity'] = $request->p_quanity;
        $data['description'] = $request->p_desc;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $filename);
            $data['image'] = $filename;
        }
        $update_data = ProductModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Product Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
