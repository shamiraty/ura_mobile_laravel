<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class PersonReset extends Model
{
    use HasFactory;

    protected $fillable = ['check_number', 'image', 'simu', 'status', 'user_id', 'registered_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Assuming PersonReset model has a 'check_number' column that matches the Payroll's checkNumber  in table popup modal
    public function payroll()
    {
        return $this->hasOne(Payroll::class, 'check_number', 'check_number');
    }
    

}
