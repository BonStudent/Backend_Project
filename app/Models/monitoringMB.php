<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringMB extends Model
{
    use HasFactory;

    protected $table = 'monitoring_mb';

    protected $fillable = [
        'month',
        'petitioner',
        'location',
        'travel_date',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
        'map',
    ];
}