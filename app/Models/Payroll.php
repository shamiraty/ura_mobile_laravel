<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;

    protected $primaryKey = 'checkNumber';
    protected $fillable = ['department', 'checkNumber', 'fname', 'mname', 'lname', 'bankName', 'accountNumber', 'grossAmount', 'basicSalary', 'netAmount', 'allowance', 'created_at'];

    public function person()
    {
        // Ensure the foreign key 'check_number' in Payroll matches the 'check_number' in Person
        return $this->belongsTo(PersonNew::class, 'check_number', 'check_number');
    }

    public function personreset()
    {
        return $this->belongsTo(PersonReset::class, 'check_number', 'check_number');
    }
    
}
