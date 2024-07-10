<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartData extends Model
{
    use HasFactory;

    protected $table = 'chart_data';

    protected $fillable = ['year', 'bar_data', 'pie_data'];
}