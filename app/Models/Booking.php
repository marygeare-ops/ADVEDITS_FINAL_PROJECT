<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'event_type',
        'event_date',
        'event_time',
        'event_end_time',
        'service',
        'service_id',
        'service_name_snapshot',
        'event_location',
        'message',
        'total_amount',
        'booking_status',
        'payment_status',
        'rescheduled_date',
        'rescheduled_time',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'rescheduled_date' => 'date',
            'total_amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function servicePackage(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}