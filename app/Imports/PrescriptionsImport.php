<?php

namespace App\Imports;

use App\Models\Prescription;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrescriptionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Prescription([
            'name' => $row['name'],
            'strength' => $row['strength'],
            'commercial_name' => $row['commercial_name'],
        ]);
    }
}
