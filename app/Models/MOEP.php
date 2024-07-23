<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOEP extends Model
{
    use HasFactory;

    protected $table = 'm_o_e_p_s';

    protected $fillable = [
        'name',
        'moep_no',
        'permit_no',
        'issued',
        'validated',
        'reportPDF',
    ];
}