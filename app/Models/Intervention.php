<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;



    protected $fillable = [
        'work_orders_technicians_id',
        'date',
        'remarks',
        'time_from',
        'time_to',
        'hours'

    ];



    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
