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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('sale')->default(false);
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->unsignedBigInteger('user_id');
            $table->year('release_year');
            $table->string('developer');
            $table->string('platform');
            $table->longText('installation_file')->nullable();
            $table->longText('installation_file_link')->nullable();
            $table->longText('cover');
            $table->longText('video');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
