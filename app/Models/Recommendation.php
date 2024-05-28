<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $table = 'recommendation';

    protected $fillable = [
        'id_reference',
        'input1',
        'input2',
        'input3',
        'input4',
        'input5',
        'input6',
        'input7',
        'input8',
        'input9',
        'input10',
        'input11',
        'input12',
        'input13',
        'input14',
        'input15',
        'input16',
        'input17',
        'input18',
        'input19',
        'input20',
        'images1',
        'images2',
        'images3',
        'images4',
        'images5',
    ];

    public $timestamps = false;
}
