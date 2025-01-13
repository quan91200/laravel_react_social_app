<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->string('image_url', 255)->nullable(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('post')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('comment')->onDelete('cascade'); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
