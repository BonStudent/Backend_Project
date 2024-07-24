<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringWPM extends Model
{
    use HasFactory;

    protected $table = 'monitoring_wpm';

    protected $fillable = [
        'text_field',
        'travel_date',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
    ];
}
