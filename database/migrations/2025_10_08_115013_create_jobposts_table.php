<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
           $table->id();
            $table->string('title');
            $table->string('company');
            $table->string('location');
            $table->enum('type', ['Full-time', 'Part-time', 'Remote', 'Contract']);
            $table->string('category');
            $table->string('salary')->nullable();
            $table->text('description');
            $table->json('requirements')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable(); 
            $table->date('publishdate')->nullable(); // Publish date
            $table->date('dateline')->nullable(); // Deadline
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobposts');
    }
};
