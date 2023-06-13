<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    public function index()
    {
        return view('master/site/list');
    }
    public function get_data()
    {
        $data['site'] = SiteModel::where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        return view('master/site/list_ajax', $data);
    }
    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = SiteModel::where('name', $name)->first();
            if (!empty($check)) {
                return response()->json(['code' => 402, 'message' => 'Site Already Exist']);
            } else {
                $data['name'] = $request->name;
                $data['location'] = $request->location;
                $insert_data = SiteModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Site Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function edit_site(Request $request)
    {
        $id = $request->id;
        $data['site_data'] = SiteModel::where('id', $id)->first();
        return view('master/site/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['name'] = $request->name;
        $data['location'] = $request->location;
        $update_data = SiteModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Site Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function get_name(Request $request)
    {
        $id = $request->id;
        $data = SiteModel::where('id', $id)->first();
        $site_name = $data->name .' ('.$data->location.')';
        return $site_name;
    }
}
