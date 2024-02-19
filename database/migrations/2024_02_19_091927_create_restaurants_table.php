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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->unsignedInteger('user_id');
            $table->string('address');
            $table->string('vat_number')->nullable();
            $table->string('phone_number');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('closure_day');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign('restaurants_user_id_foreign');
            $table->dropColumn('user_id');
        });
        
        Schema::dropIfExists('restaurants');
    }
};
