<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Session extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sessions';
    protected $primaryKey = 'id';
    protected $fillable = [ 'admin_id' ];
    protected $keyType = 'string';
    public $incrementing = false;

}
