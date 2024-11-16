<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class PersonNew extends Model
{
    use HasFactory;

    protected $fillable = ['check_number', 'image', 'simu', 'status', 'user_id', 'registered_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payroll()
    {
        // Ensure the foreign key 'check_number' matches the 'check_number' in Payroll
        return $this->hasOne(Payroll::class, 'checkNumber', 'check_number');
    }
    
}
