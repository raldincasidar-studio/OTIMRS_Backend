<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'description',
        'location',
        'due_date',
        'cost',
        'capacity',
        'rating',
        'image_url',
        'contact_number',
    ];
}
