<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('title');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('advocate_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('practice_area_id')->nullable()->constrained()->nullOnDelete();
            $table->string('opponent_name')->nullable();
            $table->text('opponent_details')->nullable();
            $table->string('court_name')->nullable();
            $table->string('court_case_number')->nullable();
            $table->enum('status', ['active', 'pending', 'dismissed', 'settled', 'closed', 'won', 'lost'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('description')->nullable();
            $table->decimal('fees', 12, 2)->default(0);
            $table->date('filed_date')->nullable();
            $table->date('next_hearing_date')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['case_number']);
            $table->index(['client_id', 'status']);
            $table->index(['advocate_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};