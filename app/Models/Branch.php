<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'registered_date_auto'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->name = strtolower($model->name);
        });
    }
}
