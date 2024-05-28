<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $fillable = [
        'id_reference',
        'images1',
        'images2',
        'images3',
        'images4',
        'images5',
        'images6',
        'images7',
        'images8',
        'images9',
        'images10',
        'images11',
        'images12',
        'images13',
        'images14',
        'images15',
        'images16',
        'images17',
        'images18',
        'images19',
        'images20',
    ];

    public $timestamps = false;
}
