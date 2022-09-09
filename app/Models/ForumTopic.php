<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    // Relationship to user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // Relationship to comments
    public function comments() {
        return $this->hasMany('App\Models\ForumComment');
    }
}
