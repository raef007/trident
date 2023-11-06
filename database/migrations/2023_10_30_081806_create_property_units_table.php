<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_units', function (Blueprint $table) {
            $table->id();
            $table->integer('estate');
            $table->string('label');
            $table->string('address');
            $table->integer('billing_day');
            $table->string('photo')->default('');
            $table->json('tags')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('unit_recurring_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('unit');
            $table->integer('item');
            $table->decimal('rate', 19, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_units');
        Schema::dropIfExists('unit_recurring_bills');
    }
};
