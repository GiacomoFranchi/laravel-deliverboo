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
        Schema::table('food_items', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable(); // Make it nullable if the relationship can be optional
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('set null'); // Use 'set null' on delete if it's nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_items', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']); 
            $table->dropColumn('restaurant_id');
        });
    }
};
