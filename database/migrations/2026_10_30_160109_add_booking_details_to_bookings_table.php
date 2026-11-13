<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            $table->string('event_type');
            $table->date('event_date');
            $table->time('event_time');
            $table->time('event_end_time');
            $table->string('service');
            $table->string('event_location');
            $table->text('message')->nullable();

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('booking_status')->default('pending');
            $table->string('payment_status')->default('pending');

            $table->date('rescheduled_date')->nullable();
            $table->time('rescheduled_time')->nullable();
            $table->text('admin_notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'customer_email',
                'customer_phone',
                'event_type',
                'event_date',
                'event_time',
                'event_end_time',
                'service',
                'event_location',
                'message',
                'total_amount',
                'booking_status',
                'payment_status',
                'rescheduled_date',
                'rescheduled_time',
                'admin_notes',
            ]);
        });
    }
};