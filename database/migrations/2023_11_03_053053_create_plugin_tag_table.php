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
        Schema::create('plugin_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plugin_id');
            $table->unsignedBigInteger('tag_id');

            $table->timestamps();
            $table->foreign('plugin_id')->references('id')->on('plugins');
            $table->foreign('tag_id')->references('id')->on('tags');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugin_tag');
    }
};
