<?php

namespace App\Imports;

use App\Models\ExpenseModel;
use App\Models\SalesModel;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;

class ImportExpense implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return $row;
        return new ExpenseModel([
            'date'    => $row['B'],
            'state'    => $row['C'],
            'client_id'    => $row['D'],
            'location'    => $row['E'],
            'service_type'    => $row['F'],
            'description'    => $row['G'],
            'amount'    => $row['H'],
            'category'    => $row['I'],
            'subcategory'    => $row['J'],
            'pay_mode'    => $row['K'],
            'date_of_payment'    => $row['L'],
            'receipt_date'    => $row['M'],
            'transporte'    => $row['N'],
            
        ]);
    }
}
