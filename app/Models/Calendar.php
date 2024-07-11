<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';
    protected $primaryKey = 'id_calendar';

    protected $fillable = [
        'id_calendar',
        'name',
        'day',
        'month',
        'year',
        'color',
        'recurrent',
    ];
}
