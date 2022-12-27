<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($export_details, $dataHeader)
    {
        $this->export_details = $export_details;
        $this->dataHeader = $dataHeader;
    }

    public function headings(): array
    {
        return $this->dataHeader;
    } 

    public function array(): array
    {
        return $this->export_details;
    }
}
