<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAttraction extends Model
{
    use HasFactory;


    protected $table = 'tourist_attractions';

    protected $fillable = [
        'name',
        'description',
        'location',
        'category',
        'opening_hours',
        'admission_fee',
        'image_url',
        'rating',
        'latitude',
        'longitude',
        'contact_phone',
        'contact_email',
        'website',
    ];
}
