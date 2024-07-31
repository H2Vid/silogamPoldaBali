<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // banner schema
        /**
         * Dont forget to register this fields to its model $fillable too. (Mandatory)
         */
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->nullable();
            $table->unsignedInteger('sort_no')->nullable();
            $table->timestamps();

            $table->string('title')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};