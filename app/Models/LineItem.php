<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class LineItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'description',
        'amount'
    ];

    // relationship to Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
