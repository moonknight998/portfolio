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
        Schema::create('feature_tab_items', function (Blueprint $table) {
            $table->id();
            $table->string('tab_name');
            $table->string('tab_id');
            $table->text('first_description');
            $table->text('first_title');
            $table->text('second_description');
            $table->text('second_title');
            $table->text('third_description');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_tab_items');
    }
};
