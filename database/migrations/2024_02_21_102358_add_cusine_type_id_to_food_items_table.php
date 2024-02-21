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
            $table->unsignedBigInteger('cusine_type_id')->nullable()->after('id');
            $table->foreign('cusine_type_id')->references('id')->on('cusine_types')->nullOnDelete();
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
            $table->dropForeign('food_items_cusine_type_id_foreign');
            $table->dropColumn('cusine_type_id');
        });
    }
};
