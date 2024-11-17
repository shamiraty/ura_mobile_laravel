<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'registered_date_auto'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->role = strtolower($model->role);
        });
    }

    public function isSuperuser()
    {
        return $this->role && $this->role->role === 'superuser';  // Assuming 'superuser' is a role
    }
    //profile icon
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    


    
}
