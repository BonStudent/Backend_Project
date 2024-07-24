<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringInvestigation extends Model
{
    use HasFactory;

    protected $table = 'monitoring_investigation';

    protected $fillable = [
        'text_field',
        'complaint_received',
        'date_acted_from', //from-to
        'date_acted_to',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'remarks',
        'MOVpdf',
    ];
}