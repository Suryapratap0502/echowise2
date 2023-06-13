<?php

namespace App\Http\Controllers;

use App\Exports\ExportSales;
use App\Models\ProductModel;
use App\Models\SalesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function index()
    {
        $data['product'] = ProductModel::where('flag', '!=', '2')->get();
        $data['exist_pro'] = SalesModel::with('product')->where('flag', '!=', '2')->distinct()->get(['item_name']);
        return view('sale/list', $data);
    }

    public function get_data()
    {
        $data['sale_data'] = SalesModel::with('product')->where('flag', '!=', '2')->get();
        return view('sale/list_ajax', $data);
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'date' => 'required',
            'item_name' => 'required',
            'qty' => 'required',
            'rate' => 'required',
            'amount' => 'required',
            'payment' => 'required',
            'pay_date' => 'required'

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            for ($y = 0; $y < count($request->date); ++$y) {

            $data['date'] = $request->date[$y];
            $data['item_name'] = $request->item_name[$y];
            $data['qty'] = $request->qty[$y];
            $data['rate'] = $request->rate[$y];
            $data['amount'] = $request->amount[$y];
            $data['payment'] = $request->payment[$y];
            $data['payment_date'] = $request->pay_date[$y];
            $data['status'] = $request->status[$y];
            $insert_data = SalesModel::insert($data);  
            }
            
            if ($insert_data) {
                return response()->json(['code' => 200, 'message' => 'Sale Added']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function edit_sale(Request $request)
    {
        $id = $request->id;
        $data['product'] = ProductModel::where('flag', '!=', '2')->get();
        $data['sale_edit_data'] = SalesModel::where('id', $id)->first();
        return view('sale/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['date'] = $request->date;
        $data['item_name'] = $request->item_name;
        $data['qty'] = $request->qty;
        $data['rate'] = $request->rate;
        $data['amount'] = $request->amount;
        $data['payment'] = $request->payment;
        $data['payment_date'] = $request->pay_date;
        $data['status'] = $request->status;
        $update_data = SalesModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Sale Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function export()
    {
        $arr = array();
        $sale_list = SalesModel::all();

        array_push($arr, array(
            'S. No.',
            'Date',
            'Item Name',
            'Quantity',
            'Rate',
            'Amount',
            'Payment',
            'Payment Date',
            'Sale Status',
            'Added Date',
            
        ));

        if (!empty($sale_list)) {
            foreach ($sale_list as $key => $value) {
                $item_name = ProductModel::where('id', $value->item_name)->first();
                array_push($arr, array(
                    'S. No.' => $key + 1,
                    'Date' => $value->date ?? '',
                    'Item Name' => $item_name->name ?? '',
                    'Quantity' => $value->qty ?? '',
                    'Rate' => $value->rate ?? '',
                    'Amount' => $value->amount ?? '',
                    'Payment' => $value->payment ?? '',
                    'Payment Date' => $value->payment_date ?? '',
                    'Sale Status' => $value->status ?? '',
                    'Added Date' => $value->created_at ?? '',
                    
                ));
            }
        }

        return Excel::download(new ExportSales($arr), 'sale_report.xlsx');
    }

    public function importexcel()
    {
        $data = Excel::toArray([], request()->file('uploadFile'));
        if (!empty($data)) {
            foreach ($data[0] as $key => $row) {
                if ($key >= 1) {
                    if (!empty($row['0'])) {

                        $savedata['date'] = $row[0] ?? '';
                        $get_pro_name = ProductModel::where('name',$row[1])->first();

                        $savedata['item_name'] = $get_pro_name->id ?? '';
                        $savedata['qty'] = $row[2] ?? '';
                        $savedata['rate'] = $row[3] ?? '';
                        $savedata['amount'] = $row[4] ?? '';
                        $savedata['payment'] = $row[5] ?? '';
                        $savedata['payment_date'] = $row[6] ?? '';
                        $savedata['status'] = $row[7] ?? '';
                        $saved = SalesModel::insert($savedata);
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
