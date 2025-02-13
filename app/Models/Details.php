<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;
    protected $table = 'details';

    protected $fillable = [
        'stage_of_processing', 'stage_of_processing_details', 'status',
        'tenement_number', 'tenement_name', 'area_hectares','area_hectares1','area_hectares2','area_hectares3', 'date_filed',
        'barangay', 'barangay1', 'barangay2', 'barangay3',
        'city', 'city1', 'city2', 'city3',
        'province', 'province1', 'province2', 'province3',
        'commodity', 'authorized_rep', 'category', 'contact_no',
        'email', 'address', 'oth_rs', 'others', 'application'
    ];

    public $timestamps = false;
}
