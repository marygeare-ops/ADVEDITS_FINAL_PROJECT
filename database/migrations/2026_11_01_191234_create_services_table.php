<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Event category
            $table->string('event_type', 100);

            // Package details
            $table->string('name', 150);
            $table->string('service_type', 50);
            $table->text('description')->nullable();

            // Package price
            $table->decimal('price', 10, 2);

            // Photography and videography details
            $table->unsignedSmallInteger('coverage_hours')->nullable();
            $table->unsignedSmallInteger('photographer_count')->nullable();
            $table->unsignedSmallInteger('videographer_count')->nullable();
            $table->unsignedSmallInteger('edited_photo_count')->nullable();
            $table->string('video_duration', 100)->nullable();

            // Package inclusions
            $table->json('inclusions')->nullable();

            // Package display settings
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
