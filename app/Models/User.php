<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Contact;
use App\Models\Task;
use App\Models\Invoice;
use App\Models\TimeSlot;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'avatar',
        'email',
        'password',
        'logo',
        'business_name',   
        'paypal_link',
        'cashapp_tag',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship to contacts
    public function contacts() {
        return $this->hasMany(Contact::class, 'user_id');
    }

    // Relationship to tasks
    public function tasks() {
        return $this->hasMany(Task::class, 'user_id');
    }

    // Relationship to invoices
    public function invoices() {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    // Relationship To TimeSlots
    public function timeSlots() {
        return $this->hasMany(TimeSlot::class, 'user_id');
    }

    // Relationship To Forum Topics
    public function forumTopics() {
        return $this->hasMany(ForumTopic::class, 'user_id');
    }
}
