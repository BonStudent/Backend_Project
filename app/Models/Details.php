<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;
    protected $table = 'details';

    protected $fillable = [
        'status',
        'tenement_number',
        'tenement_name',
        'area_hectares',
        'date_filed',
        'barangay',
        'city',
        'province',
        'commodity',
        'authorized_rep',
        'category',
        'contact_no',
        'email',
        'others',
        'stage_of_processing',
        'application',
    ];

    public $timestamps = false;
}
