<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->decimal('add_amount', 10,2)->nullable();
            $table->decimal('withdraw_amount', 10,2)->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->tinyInteger('status')->comment('1=>add_amount, 2=>withdraw_amount');
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
        Schema::dropIfExists('vendor_transactions');
    }
}
