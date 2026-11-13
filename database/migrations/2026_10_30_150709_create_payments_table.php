
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Customer information
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Event information
            $table->string('event_type');
            $table->date('event_date');
            $table->time('event_time');
            $table->time('event_end_time');
            $table->string('service');
            $table->string('event_location');
            $table->text('message')->nullable();

            // Booking and payment information
            $table->decimal('total_amount', 10, 2);
            $table->string('booking_status')->default('pending');
            $table->string('payment_status')->default('pending');

            // Admin rescheduling information
            $table->date('rescheduled_date')->nullable();
            $table->time('rescheduled_time')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
