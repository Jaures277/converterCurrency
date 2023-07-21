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
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('currency_id_from')->unsigned()->nullable();
            $table->foreign('currency_id_from')->references('id')->on('currencies')->onDelete('CASCADE');
            $table->bigInteger('currency_id_to')->unsigned()->nullable();
            $table->foreign('currency_id_to')->references('id')->on('currencies')->onDelete('CASCADE');
            $table->float('rate');
            $table->integer('exchange_number')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairs');
    }
};
