<?php

namespace App\Models;

use App\Models\userDetail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'name', 'email', 'password','roles_name','Status', 'civil_registry', 'section_id'
    ];

    public function userDetail(){
        return $this->hasOne(UserDetail::class,'user_id','id');
    }
    function section()  {
        return $this->belongsTo(Sections::class,'section_id')->withDefault('');
    }
    function requests() {
        return $this->hasMany(Requests::class);
    }
    function manager()  {
        return $this->belongsTo(EmployeeManager::class,'employee_civil_registry');
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];


}
