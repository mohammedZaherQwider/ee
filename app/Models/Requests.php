<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_civil_id', 'current_department_id', 'transfer_deparment_id'
        , 'date', 'current_manager_acceptance', 'general_manager_acceptance', 'transfer_manager_acceptance'
    ];
    function user()
    {
        return $this->belongsTo(User::class, 'employee_civil_id');
    }
    function section()
    {
        return $this->belongsTo(Sections::class, 'transfer_deparment_id')->withDefault();
    }
}
