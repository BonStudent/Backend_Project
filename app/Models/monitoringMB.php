<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringMB extends Model
{
    use HasFactory;

    protected $table = 'monitoring_mb';

    protected $primaryKey = 'ID'; // Define the primary key column

    protected $fillable = [
        'month',
        'petitioner',
        'location',
        'travel_date_from',
        'travel_date_to',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
        'map',
    ];
}