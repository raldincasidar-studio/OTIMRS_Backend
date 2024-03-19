<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'days',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'address',
        'nationality',
    ];
}
