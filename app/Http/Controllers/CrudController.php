<?php

namespace App\Http\Controllers;

use App\Models\CrudModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;

class CrudController extends Controller
{
    public function index()
    {
        return view('crud/list');
    }

    public function get_data()
    {
        // $data['category'] = CrudModel::list_common($table);
        return view('crud/list_ajax');
    }

    public function add(Request $request)
    {
        // table and coloumn name
        $table_name = $request->table_name;
        $colomn = $request->coloumn_name;
        $colomn1 = $request->coloumn_name1;
        $colomn2 = $request->coloumn_name2;
        $colomn3 = $request->coloumn_name3;
        $colomn4 = $request->coloumn_name4;
        
        // check table
        Schema::dropIfExists($table_name);
        //create table
        Schema::create($table_name, function (Blueprint $table) use($colomn,$colomn1,$colomn2,$colomn3,$colomn4) {
            $table->id();
            $table->string($colomn);
            $table->string($colomn1);
            $table->string($colomn2)->unique();
            $table->string($colomn3);
            $table->string($colomn4);
            $table->string('flag');
            $table->rememberToken();
            $table->timestamps();
        });

        //Validation for Data
        $validate = Validator::make($request->all(), [
            'emp_name' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $name = $request->emp_name;

            $table_check = new CrudModel('employee');
            $check = $table_check::where($table_name, $name)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'User Already Exist']);
            } else {
                $data[$colomn] = $request->emp_name;
                $data[$colomn1] = $request->emp_email;
                $data[$colomn2] = $request->emp_password;
                $data[$colomn3] = $request->emp_contact;
                $data[$colomn4] = $request->emp_address;
                $insert_data = CrudModel::insert($data);
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Data Added']);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }

    }
}
