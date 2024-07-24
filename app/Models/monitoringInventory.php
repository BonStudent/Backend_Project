<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringInventory extends Model
{
    use HasFactory;

    protected $table = 'monitoring_inventory';

    protected $fillable = [
        'month',
        'location',
        'travel_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
    ];
}