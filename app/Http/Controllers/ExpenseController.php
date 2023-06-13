<?php

namespace App\Http\Controllers;

use App\Exports\ExportExpense;
use App\Models\CashmanagementModel;
use App\Models\CategoryModel;
use App\Models\ClientModel;
use App\Models\ExpenseModel;
use App\Models\ServicetypeModel;
use App\Models\StateModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function index()
    {
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->get();
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        $data['client'] = ClientModel::where('flag', '!=', '2')->get();
        $data['sub_category'] = SubcategoryModel::where('flag', '!=', '2')->get();
        $data['pay_mode'] = CashmanagementModel::where('flag', '!=', '2')->get();
        $data['state'] = StateModel::where('flag', '!=', '2')->get();
        $data['exist_client'] = ExpenseModel::with('client')->where('flag', '!=', '2')->distinct()->get(['client_id']);
        return view('expense/list', $data);
    }
    public function get_data()
    {
        $data['expense'] = ExpenseModel::with('client', 'category_name', 'service_ty', 'sub_category', 'pay_m')->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();
        $data['state'] = StateModel::where('flag', '!=', '2')->get();
        return view('expense/list_ajax', $data);
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
            'date' => 'required',
            'service_type' => 'required',
            'amount' => 'required',
            'category' => 'required',
            'sub_cat' => 'required',
            'pay_mode' => 'required',
            'date_pay' => 'required',
            'date_receipt' => 'required',
            'transport' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            for ($y = 0; $y < count($request->client_id); ++$y) {

                $data['client_id'] = $request->client_id[$y];
                $data['state'] = $request->state[$y];
                $data['location'] = $request->location[$y];
                $data['date'] = $request->date[$y];
                $data['service_type'] = $request->service_type[$y];
                $data['description'] = $request->description[$y];
                $data['amount'] = $request->amount[$y];
                $data['category'] = $request->category[$y];
                $data['subcategory'] = $request->sub_cat[$y];
                $data['pay_mode'] = $request->pay_mode[$y];
                $data['date_of_payment'] = $request->date_pay[$y];
                $data['receipt_date'] = $request->date_receipt[$y];
                $data['transporte'] = $request->transport[$y];
                $insert_data = ExpenseModel::insert($data);
            }
            if ($insert_data) {
                return response()->json(['code' => 200, 'message' => 'Expense Added']);
            } else {
                return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function edit_expense(Request $request)
    {
        $id = $request->id;
        $data['service_type'] = ServicetypeModel::where('flag', '!=', '2')->get();
        $data['category'] = CategoryModel::where('flag', '!=', '2')->get();
        $data['client'] = ClientModel::where('flag', '!=', '2')->get();
        $data['sub_category'] = SubcategoryModel::where('flag', '!=', '2')->get();
        $data['pay_mode'] = CashmanagementModel::where('flag', '!=', '2')->get();
        $data['state'] = StateModel::where('flag', '!=', '2')->get();
        $data['expense_data'] = ExpenseModel::where('id', $id)->first();
        return view('expense/edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data['client_id'] = $request->client_id;
        $data['date'] = $request->date;
        $data['service_type'] = $request->service_type;
        $data['description'] = $request->description;
        $data['amount'] = $request->amount;
        $data['category'] = $request->category;
        $data['subcategory'] = $request->sub_cat;
        $data['pay_mode'] = $request->pay_mode;
        $data['date_of_payment'] = $request->date_pay;
        $data['receipt_date'] = $request->date_receipt;
        $data['transporte'] = $request->transport;
        $data['state'] = $request->state;
        $data['location'] = $request->location;
        $update_data = ExpenseModel::where('id', $id)->update($data);
        if ($update_data) {
            return response()->json(['code' => 200, 'message' => 'Expense Updated']);
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }

    public function export()
    {
        $arr = array();
        $expense_list = ExpenseModel::all();

        array_push($arr, array(
            'S. No.',
            'Date',
            'State',
            'Client Name',
            'Location',
            'Service Type',
            'Description',
            'Amount',
            'Category',
            'Sub Category',
            'Payment Mode',
            'Date Of Payment',
            'Receipt Date',
            'Transport',
            'PAN',
            'Created At',

        ));

        if (!empty($expense_list)) {
            foreach ($expense_list as $key => $value) {
                $state_name = StateModel::where('id', $value->state)->first();
                $cl_name = ClientModel::where('id', $value->client_id)->first();
                $ser_type = ServicetypeModel::where('id', $value->service_type)->first('name');
                $cat_name = CategoryModel::where('id', $value->category)->first('category');
                $sub_cat_name = SubcategoryModel::where('id', $value->subcategory)->first('subcategory');
                $pay_mode = CashmanagementModel::where('id', $value->pay_mode)->first('pay_method');
                array_push($arr, array(
                    'S. No.' => $key + 1,
                    'Date' => $value->date ?? '',
                    'State' => $state_name->state_name ?? '',
                    'Client Name' => $cl_name->name ?? '',
                    'Location' => $value->location ?? '',
                    'Service Type' => $ser_type->name ?? '',
                    'Description' => $value->description ?? '',
                    'Amount' => $value->amount ?? '',
                    'Category' => $cat_name->category ?? '',
                    'Sub Category' => $sub_cat_name->subcategory ?? '',
                    'Payment Mode' => $pay_mode->pay_method ?? '',
                    'Date Of Payment' => $value->date_of_payment ?? '',
                    'Receipt Date' => $value->receipt_date ?? '',
                    'Transport' => $value->transporte ?? '',
                    'PAN' => $cl_name->pan ?? '',
                    'Created At' => $value->created_at ?? ''

                ));
            }
        }

        return Excel::download(new ExportExpense($arr), 'expense.xlsx');
    }

    public function importexcel()
    {
        $data = Excel::toArray([], request()->file('uploadFile'));
        if (!empty($data)) {
            foreach ($data[0] as $key => $row) {
                if ($key >= 1) {
                    if (!empty($row['0'])) {

                        $savedata['date'] = $row[0] ?? '';
                        $get_state_id = StateModel::where('state_name',$row[1])->first();

                        $savedata['state'] = $get_state_id->id ?? '';
                        // get client Id
                        $get_cl_id = ClientModel::where('name',$row[2])->first();
                        $savedata['client_id'] = $get_cl_id->id ?? '';

                        $savedata['location'] = $row[3] ?? '';
                        // get service type
                        $get_ser_type_id = ServicetypeModel::where('name',$row[4])->first();
                        $savedata['service_type'] = $get_ser_type_id->id ?? '';

                        $savedata['description'] = $row[5] ?? '';
                        $savedata['amount'] = $row[6] ?? '';
                        // get category name
                        $get_cat_id = CategoryModel::where('category',$row[7])->first();
                        $savedata['category'] = $get_cat_id->id ?? '';

                        // get subcategory name
                        $get_subcat_id = SubcategoryModel::where('subcategory',$row[8])->first();
                        $savedata['subcategory'] = $get_subcat_id->id ?? '';

                        // get payment method
                        $get_pay_mode_id = CashmanagementModel::where('pay_method',$row[9])->first();
                        $savedata['pay_mode'] = $get_pay_mode_id->id ?? '';

                        $savedata['date_of_payment'] = $row[10] ?? '';
                        $savedata['receipt_date'] = $row[11] ?? '';
                        $savedata['transporte'] = $row[12] ?? '';
                        $saved = ExpenseModel::insert($savedata);
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
