<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringWPM extends Model
{
    use HasFactory;

    protected $table = 'monitoring_wpm';

    protected $primaryKey = 'ID'; //primary key

    protected $fillable = [
        'month',
        'text_field',
        'travel_date_from',
        'travel_date_to',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
    ];
}
