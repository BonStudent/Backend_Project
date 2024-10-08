<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringOSTC extends Model
{
    use HasFactory;

    protected $table = 'monitoring_ostc';

    protected $primaryKey = 'no'; // Define the primary key column if it's not 'id'

    protected $fillable = [
        'client',
        'certification_no',
        'received_ord',
        'received_mmd',
        'payment_date',
        'sample_inspection',
        'issued',
        'mmd_personnel',
        'MOVpdf',
    ];
}