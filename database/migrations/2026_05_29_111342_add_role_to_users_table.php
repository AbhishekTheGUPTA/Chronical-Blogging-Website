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
        

        Schema::create('posts', function(Blueprint $table) {
            $table->id();
            $table->ForeignID('Fk_userId')->contraint()->cascadeOnDelete();
            $table->string('title', 255);
            $table->longtext('body');
            $table->string('slug', 255);
            $table->string('featured_image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->updateCurrent();
            $table->softDeletes(); 
        });

        Schema::create('comments', function(Blueprint $table) {
            $table->id();
            $table->ForeignID('Fk_userId')->contraint()->cascadeOnDelete();
            $table->ForeignID('Fk_postId')->contraint()->cascadeOnDelete();
            $table->longtext('body');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->updateCurrent();
            $table->softDeletes(); 
        });

        Schema::create('Categories', function(Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->updateCurrent();
            $table->softDeletes(); 
        });

        Schema::create('Category_Post', function(Blueprint $table) {
            $table->id();
            $table->ForeignID('Fk_categoryId')->contraint()->cascadeOnDelete();
            $table->ForeignID('Fk_postId')->contraint()->cascadeOnDelete();
            $table->softDeletes(); 
        });

        Schema::create('Tags', function(Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->updateCurrent();
            $table->softDeletes(); 
        });

        Schema::create('Post_tag', function(Blueprint $table) {
            $table->id();
            $table->ForeignID('Fk_postId')->contraint()->cascadeOnDelete();
            $table->ForeignID('Fk_tagId')->contraint()->cascadeOnDelete();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });

        Schema::dropIfExists('posts');
    }
};
