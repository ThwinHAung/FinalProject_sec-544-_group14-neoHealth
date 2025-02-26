<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //
    protected $fillable = [
        'appointment_id', 
        'medicine_name', 
        'description', 
        'dosage', 
        'start_date', 
        'end_date', 
        'note'
    ];
}
