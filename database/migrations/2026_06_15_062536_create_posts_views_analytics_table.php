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
        Schema::create('posts_views_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Fk_postId')->constrained('posts');
            $table->string('ip_address');
            $table->date('viewed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_views_analytics');
    }
};
