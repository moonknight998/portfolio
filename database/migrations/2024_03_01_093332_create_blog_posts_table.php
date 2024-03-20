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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->text('post_title');
            $table->text('slug');
            $table->string('thumbnail');
            $table->longText('post_content');
            $table->foreignId('category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->string('post_author');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
