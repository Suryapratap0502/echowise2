<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;


class CommonController extends Controller
{
    public function change_status(Request $request)
    {
        $id = $request->id;
        $table = $request->table;
        $keys = $request->keys;
        if($keys == 'Deleted')
        {
            $data['flag'] = '2';
        }else if($keys == 'Deactivate')
        {
            $data['flag'] = '1';
        }else if($keys == 'Activate')
        {
            $data['flag'] = '0';
        }
        $delete_data = AdminModel::deletedata($table,$id,$data);
        if ($delete_data) {
            return response()->json(['code' => 200, 'message' => 'Data ' . $keys]);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}