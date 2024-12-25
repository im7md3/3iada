<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PatientsExport implements FromCollection,WithMapping,WithHeadings
{
    public $patients;
    public function __construct($patients)
    {
        $this->patients = $patients;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->patients;
    }

    public function map($row) : array
    {
        return [
            $row->id,
            $row->name,
            $row->country?->name ?? null,
            $row->phone,
            __($row->gender),
            __($row->age_type),
            $row->civil,
            $row->invoices()->paid()->count(),
            $row->invoices()->unpaid()->count(),
            $row->invoices()->PartiallyPaid()->count(),
            $row->user?->name
        ];
    }

    public function headings(): array
    {
        return [
            __('admin.Medical number'),
            __('admin.name'),
            __('admin.Country'),
            __('admin.phone'),
            __('Gender'),
            __('Age type'),
            __('admin.Civil number'),
            __('Paid bills'),
            __('Unpaid bills'),
            __('Partially Paid'),
            __('admin.Last modified by'),
        ];
    }
}
