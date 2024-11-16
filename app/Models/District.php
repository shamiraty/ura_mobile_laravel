<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'branch_id', 'registered_date_auto'];

    public function branch()
    {
        return $this->belongsTo(Branch::class); // defines the relationship to Branch
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->name = strtolower($model->name); // ensures the name is stored in lowercase
        });
    }
}
