<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manager_detail extends Model
{
    use HasFactory;

    function section()  {
        return $this->belongsTo(Sections::class,'employee_managers_id')->withDefault();
    }
    function empManager() {
        return $this->belongsTo(EmployeeManager::class,'employee_managers_id', 'employee_civil_registry');
  }
}
