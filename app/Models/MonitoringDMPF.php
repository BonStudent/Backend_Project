<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringDMPF extends Model
{
    use HasFactory;

    protected $table = 'monitoring_dmpf';

    protected $primaryKey = 'no'; // Define the primary key column

    protected $fillable = [
        'month',
        'dmpf_endorsed',
        'filing_date',
        'endorsed',
        'transmittal',
        'released',
        'MOVpdf',
    ];
}