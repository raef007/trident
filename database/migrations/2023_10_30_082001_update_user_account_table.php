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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('remember_token');
            $table->integer('organization')->after('remember_token');
            $table->softDeletes();
        });

        Schema::create('unit_tenancy', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('unit');
            $table->unsignedTinyInteger('is_primary')->default(0);
            $table->unsignedTinyInteger('is_owner')->default(0);
            $table->softDeletes();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('organization');
            $table->dropColumn('role');
        });

        Schema::dropIfExists('unit_tenancy');
    }
};
