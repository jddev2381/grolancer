<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LineItem;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'contact_id',
        'paid',
        'due_date'
    ];

    // relationship to LineItem
    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }
}
