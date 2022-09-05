<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'title',
        'body',
    ];

    // Relationship to Proposal
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
