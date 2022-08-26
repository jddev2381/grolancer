<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Activity;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'phone',
        'street',
        'city',
        'state',
        'zip',
        'type'
    ];

    // Relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to activities
    public function activities() {
        return $this->hasMany(Activity::class, 'contact_id');
    }

    // Relationship to tasks
    public function tasks() {
        return $this->hasMany(Task::class, 'contact_id');
    }

    // Setup scope filter  
    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('first_name', 'like', "%{$filters['search']}%")
                ->orWhere('last_name', 'like', "%{$filters['search']}%")
                ->orWhere('company_name', 'like', "%{$filters['search']}%")
                ->orWhere('title', 'like', "%{$filters['search']}%")
                ->orWhere('website', 'like', "%{$filters['search']}%")
                ->orWhere('email', 'like', "%{$filters['search']}%")
                ->orWhere('mobile', 'like', "%{$filters['search']}%")
                ->orWhere('phone', 'like', "%{$filters['search']}%")
                ->orWhere('street', 'like', "%{$filters['search']}%")
                ->orWhere('city', 'like', "%{$filters['search']}%")
                ->orWhere('state', 'like', "%{$filters['search']}%")
                ->orWhere('zip', 'like', "%{$filters['search']}%")
                ->orWhere('type', 'like', "%{$filters['search']}%");
        }
        if($filters['type'] ?? false) {
            $query->where('type', $filters['type']);
        }
    }
}
