<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\StateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $data['state'] = StateModel::where('flag', '!=', '2')->get();
        return view('master/client/list', $data);
    }

    public function get_data()
    {
        $data['client'] = ClientModel::with('state')->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        return view('master/client/list_ajax', $data);
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'state' => 'required',
            'location' => 'required',
            'pan' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->name;

            $check = ClientModel::where('name', $name)->orWhere('email', $request->email)->orWhere('pan', $request->pan)->first();
            if (!empty($check)) {
                return response()->json(['code' => 402, 'message' => 'Client Already Exist']);
            } else {
                $data['name'] = $request->name;
                $data['email'] = $request->email;
                $data['contact'] = $request->contact;
                $data['state_id'] = $request->state;
                $data['location'] = $request->location;
                $data['pan'] = $request->pan;

                $insert_data = ClientModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Client Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function edit_client(Request $request)
    {
        $id = $request->id;
        $data['state'] = StateModel::where('flag', '!=', '2')->get();
        $data['client_data'] = ClientModel::where('id', $id)->first();
        return view('master/client/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['contact'] = $request->contact;
        $data['state_id'] = $request->state;
        $data['location'] = $request->location;
        $data['pan'] = $request->pan;
        $update_data = ClientModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Client Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function fetch_data_cl_id(Request $request)
    {
        $id = $request->id;
        $data = ClientModel::where('id', $id)->first();
        $state_name = StateModel::where('id', $data->state_id)->first();
        return response()->json(['state' => $state_name->state_name, 'location' => $data->location,'pan' => $data->pan]);

    }
}
