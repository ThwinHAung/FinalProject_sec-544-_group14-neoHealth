<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'degree',
        'department',
        'specialty',
        'email',
        'password',
        'phone_number',
    ];
}
