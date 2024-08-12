<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoringInventory extends Model
{
    use HasFactory;

    protected $table = 'monitoring_inventory';

    protected $primaryKey = 'id_no';

    protected $fillable = [
        'month',
        'location',
        'travel_date_from',
        'travel_date_to',
        'report_date',
        'transmittal_date',
        'released_date',
        'mmd_personnel',
        'MOVpdf',
    ];
}