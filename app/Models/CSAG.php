<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSAG extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'province',
        'city_municipality',
        'barangay',
        'sitio',
        'river',
        'received',
        'released',
        'status',
        'remarks',
    ];
}
