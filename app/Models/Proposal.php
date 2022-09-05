<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'contact_id',
        'name',
        'accepted_name',
        'accepted_date',
        'accepted_ip',
        'accepted_user_agent',
        'amount',
        
    ];

    // Relationship to Contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // Relationship to ProposalSection
    public function proposalSections()
    {
        return $this->hasMany(ProposalSection::class);
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
