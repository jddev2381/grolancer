<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'direction',
        'type',
        'comment'

    ];

    // Relationship to Contact
    public function contact() {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
