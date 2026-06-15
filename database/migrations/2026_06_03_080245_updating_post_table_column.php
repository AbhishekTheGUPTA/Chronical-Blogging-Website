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
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'excerpt')) {
                $table->string('excerpt')->nullable()->after('body');
            }
            if (!Schema::hasColumn('posts', 'visibility')) {
                $table->string('visibility')->default('public')->after('excerpt');
            }
            if (!Schema::hasColumn('posts', 'custom_css_class')) {
                $table->string('custom_css_class')->nullable()->after('visibility');
            }
            if (!Schema::hasColumn('posts', 'social_description')) {
                $table->string('social_description')->nullable()->after('custom_css_class');
            }
            if (!Schema::hasColumn('posts', 'status')) {
                $table->string('status')->default('draft')->after('social_description');
            }
            if (!Schema::hasColumn('posts', 'seo_title')) {
                $table->string('seo_title')->nullable()->after('custom_css_class');
            }
            if (!Schema::hasColumn('posts', 'description')) {
                $table->text('description')->nullable()->after('seo_title');
            }
            if (!Schema::hasColumn('posts', 'social_title')) {
                $table->string('social_title')->nullable()->after('description');
            }
            if (!Schema::hasColumn('posts', 'useCanonical')) {
                $table->boolean('useCanonical')->default(false)->after('social_title');
            }
            if (!Schema::hasColumn('posts', 'noIndex')) {
                $table->boolean('noIndex')->default(false)->after('useCanonical');
            }
            if (!Schema::hasColumn('posts', 'author')) {
                $table->string('author')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('posts', 'reading_time')) {
                $table->integer('reading_time')->nullable()->after('author');
            }
            if (!Schema::hasColumn('posts', 'table_of_contents')) {
                $table->boolean('table_of_contents')->default(false)->after('reading_time');
            }
            if (!Schema::hasColumn('posts', 'show_share_buttons')) {
                $table->boolean('show_share_buttons')->default(false)->after('table_of_contents');
            }
            if (!Schema::hasColumn('posts', 'enable_comments')) {
                $table->boolean('enable_comments')->default(true)->after('show_share_buttons');
            }
            if (!Schema::hasColumn('posts', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('enable_comments');
            }
            if (!Schema::hasColumn('posts', 'publish_date')) {
                $table->timestamp('publish_date')->nullable()->after('is_featured');
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'excerpt',
                'visibility',
                'custom_css_class',
                'social_description',
                'status',
                'seo_title',
                'description',
                'social_title',
                'useCanonical',
                'noIndex',
                'author',
                'reading_time',
                'table_of_contents',
                'show_share_buttons',
                'enable_comments',
                'is_featured',
                'publish_date',
            ]);
        });
    }
};
