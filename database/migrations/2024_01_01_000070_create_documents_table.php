<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('case_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('file_path');
            $table->string('file_type');
            $table->unsignedInteger('file_size');
            $table->string('document_type')->default('general');
            $table->text('description')->nullable();
            $table->boolean('is_shared')->default(false);
            $table->timestamp('shared_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'document_type']);
            $table->index(['case_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};