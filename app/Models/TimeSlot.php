<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'contact_id',
        'start_time',
        'end_time',
        'status',
        'name',
        'description',

    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    // Relationship to contact
    public function contact() {
        return $this->belongsTo('App\Models\Contact');
    }

    // Relationship to user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
