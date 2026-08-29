<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advocate_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_booked')->default(false);
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->timestamps();

            $table->index(['advocate_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_slots');
    }
};