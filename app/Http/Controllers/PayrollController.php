<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function create()
    {
        return view('administration.payroll');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:100',
            'checkNumber' => 'required|unique:payrolls,checkNumber',
            'fname' => 'required|string|max:100',
            'mname' => 'nullable|string|max:100',
            'lname' => 'required|string|max:100',
            'bankName' => 'required|string|max:100',
            'accountNumber' => 'required|numeric',
            'grossAmount' => 'required|numeric',
            'basicSalary' => 'required|numeric',
            'netAmount' => 'required|numeric',
        ]);

        try {
            // Insert the new payroll record
            Payroll::create($request->all());

            return redirect()->route('payrolls.create')->with('success', 'Payroll record added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('payrolls.create')->with('error', 'Error adding payroll: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:csv,xlsx,xls',
        ]);

        // Retrieve the uploaded file
        $file = $request->file('excel_file');

        // Handle CSV file import
        if ($file->getClientOriginalExtension() === 'csv') {
            $path = $file->getRealPath();

            if (($handle = fopen($path, 'r')) !== FALSE) {
                $header = null;
                $data = [];

                while (($row = fgetcsv($handle)) !== FALSE) {
                    if (!$header) {
                        $header = $row;
                        continue; // Skip header row
                    }

                    // Prepare data
                    $payrollData = [
                        'department'   => $row[0], // column 1
                        'checkNumber'  => $row[1], // column 2
                        'fname'        => $row[2], // column 3
                        'mname'        => $row[3], // column 4
                        'lname'        => $row[4], // column 5
                        'bankName'     => $row[5], // column 6
                        'accountNumber'=> $row[6], // column 7
                        'grossAmount'  => $row[7], // column 8
                        'basicSalary'  => $row[8], // column 9
                        'netAmount'    => $row[9], // column 10
                    ];

                    // Check if the payroll already exists by checkNumber
                    $existingPayroll = Payroll::where('checkNumber', $row[1])->first();

                    if ($existingPayroll) {
                        // Update existing payroll record
                        $existingPayroll->update($payrollData);
                    } else {
                        // Insert new payroll record
                        $data[] = $payrollData;
                    }
                }

                fclose($handle); // Close the file

                // Insert any new records that weren't found in the database
                Payroll::insert($data);

                return redirect()->route('payrolls.create')->with('success', 'Payroll records imported and updated successfully!');
            } else {
                return redirect()->route('payrolls.create')->with('error', 'Error reading the file.');
            }
        }

        return redirect()->route('payrolls.create')->with('error', 'Invalid file format.');
    }
}
