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
        $this->down();
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('param', 100);
            $table->string('group', 50)->nullable();
            $table->text('default_value')->nullable();
            $table->timestamps();

            $table->index(['param', 'group']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};