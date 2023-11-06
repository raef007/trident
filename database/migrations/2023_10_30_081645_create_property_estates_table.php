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
        Schema::create('estate_community', function (Blueprint $table) {
            $table->id();
            $table->integer('organization');
            $table->string('name');
            $table->string('classification'); // Homes, Condominium, Apartment, Mall
            $table->string('city')->default('');
            $table->string('state')->default('');
            $table->string('country')->default('');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('estate_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('estate');
            $table->string('currency')->default('');
            $table->integer('billing_day')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('estate_recurring_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('estate');
            $table->integer('item');
            $table->json('tags')->nullable();
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
        Schema::dropIfExists('estate_community');
        Schema::dropIfExists('estate_settings');
        Schema::dropIfExists('estate_recurring_bills');
    }
};
