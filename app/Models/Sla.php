<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sla extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'client_id',
        'time_from',
        'time_to',
        'hours',
        'tasks',
        'location',
        'client_signature'

    ];
}
