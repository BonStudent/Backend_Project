<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtsrStatus extends Model
{
    use HasFactory;
    protected $table = 'mtsrstatus';

    protected $fillable = [
        'id_reference',
        'mtsr',
    ];

    public $timestamps = false;
}
