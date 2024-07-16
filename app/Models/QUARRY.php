<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QUARRY extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'province',
        'city_municipality',
        'barangay',
        'sitio',
        'lot_no',
        'survey_no',
        'received',
        'released',
        'status',
        'remarks',
    ];
}
