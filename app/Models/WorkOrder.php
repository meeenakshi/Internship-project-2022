<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;


    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'date',
        'client',
        'client_contact_no',
        'client_email',
        'product',
        'model',
        'serial_no',
        'cyber_serial_no1',
        'cyber_serial_no2',
        'warranty',
        'invoice_no',
        'accessories',
        'problem_desc',
        'taken_by',
        'ticket_no',
        'status',
        'picture',
        'client_signature_request',
        'notifiable'

        ];




}
