<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_civil_registry',
        'manager_civil_registry',
    ];
    function users() {
      return $this->hasMany(User::class);
    }
    public function managerDetail(){
        return $this->hasOne(manager_detail::class);
    }
}
