<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('nid')->nullable()->after('seller_id');
            $table->string('nid_front')->nullable()->after('nid');
            $table->string('nid_back')->nullable()->after('nid_front');
            $table->string('nominee_name')->nullable()->after('nid_back');
            $table->string('relation')->nullable()->after('nominee_name');
            $table->string('nominee_nid')->nullable()->after('relation');
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
            $table->dropColumn([
                'nid',
                'nid_front',
                'nid_back',
                'nominee_name',
                'relation',
                'nominee_nid'
            ]);
        });
    }
};
