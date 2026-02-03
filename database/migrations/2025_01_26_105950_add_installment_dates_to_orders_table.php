<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstallmentDatesToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('first_installment_date')->nullable()->after('first_installment');
            $table->date('second_installment_date')->nullable()->after('second_installment');
            $table->date('third_installment_date')->nullable()->after('third_installment');
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
            $table->dropColumn('first_installment_date');
            $table->dropColumn('second_installment_date');
            $table->dropColumn('third_installment_date');
        });
    }
}
