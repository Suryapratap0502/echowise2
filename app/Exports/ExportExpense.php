<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExpense implements FromCollection
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first()->toArray());
    }

    public function collection()
    {
        return collect($this->data);
    }
}
