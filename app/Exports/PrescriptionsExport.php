<?php

namespace App\Exports;

use App\Models\Prescription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrescriptionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prescription::select('name','strength')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['name','strength','commercial_name'];
    }
}

