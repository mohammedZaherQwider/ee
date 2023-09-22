<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'sections_id'
   ];
   function users()  {
        return $this->hasMany(User::class);
   }
   function requests() {
    return $this->hasMany(Requests::class);
   }
   function manager() {
        return $this->hasOne(manager_detail::class);
   }

}
