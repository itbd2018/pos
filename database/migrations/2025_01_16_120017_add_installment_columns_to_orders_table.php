<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstallmentColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('first_installment', 10, 2)->default(0.00)->after('discount');
            $table->decimal('second_installment', 10, 2)->default(0.00)->after('first_installment');
            $table->decimal('third_installment', 10, 2)->default(0.00)->after('second_installment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['first_installment', 'second_installment', 'third_installment']);
        });
    }
}
