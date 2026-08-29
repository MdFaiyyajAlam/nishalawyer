<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('file_path');
            $table->string('file_type');
            $table->unsignedInteger('file_size');
            $table->string('document_type')->default('other');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false);
            $table->boolean('is_shared_with_client')->default(false);
            $table->timestamps();

            $table->index(['case_id', 'document_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_documents');
    }
};