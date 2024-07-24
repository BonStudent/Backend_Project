<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringOSTC extends Model
{
    use HasFactory;

    protected $table = 'monitoringostc';

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