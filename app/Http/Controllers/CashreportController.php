<?php

namespace App\Http\Controllers;

use App\Exports\ExportCash;
use App\Models\CashreportModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CashreportController extends Controller
{
   Public function index(){
    $data['data_status'] = CashreportModel::where('flag', '!=', '2')->distinct('data_status')->get();
    return view('cashreport/list',$data);
   }

   public function get_data()
   {
    $data['cash_report'] = CashreportModel::where('flag', '!=', '2')->get();
    return view('cashreport/list_ajax', $data);
   }

   public function add(Request $request)
   {
       $validate = Validator::make($request->all(), [
           'date' => 'required',
           'cash_with' => 'required',
           'amount' => 'required',
           'data_status' => 'required'

       ]);

       if ($validate->fails()) {
           return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
       } else {
        for ($y = 0; $y < count($request->date); ++$y) {

            $data['date'] = $request->date[$y];
            $data['cash_with'] = $request->cash_with[$y];
            $data['amount'] = $request->amount[$y];
            $data['data_status'] = $request->data_status[$y];
            $insert_data = CashreportModel::insert($data);  
        }
           if ($insert_data) {
               return response()->json(['code' => 200, 'message' => 'Cash Data Added']);
           } else {
               return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
           }
       }
   }
   public function edit_cash_report(Request $request)
   {
       $id = $request->id;
       $data['cash_report'] = CashreportModel::where('flag', '!=', '2')->get();
       $data['cash_edit_data'] = CashreportModel::where('id', $id)->first();
       return view('cashreport/edit', $data);
   }

   public function update(Request $request)
   {
       $id = $request->id;
       $data['date'] = $request->date;
       $data['cash_with'] = $request->cash_with;
       $data['amount'] = $request->amount;
       $data['data_status'] = $request->data_status;
       $update_data = CashreportModel::where('id', $id)->update($data);
       if ($update_data) {
           return response()->json(['code' => 200, 'message' => 'Cash Data Updated']);
       } else {
           return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
       }
    }

    public function export()
    {
        $arr = array();
        $cash_list = CashreportModel::all();
        array_push($arr, array(
            'S. No.',
            'Cash With',
            'Amount',
            'Data Status',
            'Date',
            'Added Date',
            
        ));

        if (!empty($cash_list)) {
            foreach ($cash_list as $key => $value) {

                array_push($arr, array(
                    'S. No.' => $key + 1,
                    'Cash With' => $value->cash_with ?? '',
                    'Amount' => $value->amount ?? '',
                    'Data Status' => $value->data_status ?? '',
                    'Date' => $value->date ?? '',
                    'Added Date' => $value->created_at ?? '',
                    
                ));
            }
        }

        return Excel::download(new ExportCash($arr), 'cash_report.xlsx');
    }

    public function importexcel()
    {
        $data = Excel::toArray([], request()->file('uploadFile'));
        if (!empty($data)) {
            foreach ($data[0] as $key => $row) {
                if ($key >= 1) {
                    if (!empty($row['0'])) {
                        $savedata['cash_with'] = $row[0] ?? '';
                        $savedata['amount'] = $row[1] ?? '';
                        $savedata['data_status'] = $row[2] ?? '';
                        $savedata['date'] = $row[3] ?? '';
                        $saved = CashreportModel::insert($savedata);
                    }
                }
            }
        }

        if (!empty($saved)) {
            return response()->json(['code' => 200, 'message' =>  'Imported successfully']);
        } else {
            return response()->json(['code' => 400, 'message' =>  'Something went wrong']);
        }
    }

}