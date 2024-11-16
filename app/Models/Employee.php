<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Role;
use App\Models\Post;
use App\Models\District;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role_id', 'post_id', 'district_id', 'email', 'phone', 'force_number', 'rank', 'registered_date'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    
}
