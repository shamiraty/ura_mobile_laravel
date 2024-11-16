<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageLog extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'message', 'status', 'registered_date'];
}
