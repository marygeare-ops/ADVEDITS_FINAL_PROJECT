<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_name',
        'customer_email',
        'total_amount',
        'developer_commission',
        'adv_edits_share',
        'payment_method',
        'transaction_reference',
        'gcash_reference',
        'payment_proof',
        'submitted_at',
        'status',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'developer_commission' => 'decimal:2',
            'adv_edits_share' => 'decimal:2',
            'submitted_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
