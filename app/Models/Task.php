<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'due_date'
    ];

    // Relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to tasks
    public function contact() {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
