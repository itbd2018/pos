<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSoldToProductSerialNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_serial_numbers', function (Blueprint $table) {
            $table->boolean('is_sold')->default(false)->after('serial_number')->comment('0=>Un-Sold, 1=>Sold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_serial_numbers', function (Blueprint $table) {
            $table->dropColumn('is_sold');
        });
    }
}
