<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOEP extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant',
        'moep_no',
        'permit_no',
        'issued',
        'validated',
        'reportPDF',
    ];
}
