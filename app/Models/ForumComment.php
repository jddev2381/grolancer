<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'topic_id',
        'description',
    ];

    // Relationship to user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // Relationship to topic
    public function topic() {
        return $this->belongsTo('App\Models\ForumTopic');
    }
}
