<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Payroll;

class PayrollImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new Payroll([
            'department'   => $row['department'],
            'checkNumber'  => $row['check_number'],
            'fname'        => $row['first_name'],
            'mname'        => $row['middle_name'],
            'lname'        => $row['last_name'],
            'bankName'     => $row['bank_name'],
            'accountNumber'=> $row['account_number'],
            'grossAmount'  => $row['gross_amount'],
            'basicSalary'  => $row['basic_salary'],
            'netAmount'    => $row['net_amount'],
            'created_at'   => now(),
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // Process in chunks of 1000 records
    }
}
