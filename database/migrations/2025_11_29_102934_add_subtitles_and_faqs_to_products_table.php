<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubtitlesAndFaqsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('subtitle_1')->nullable()->after('name_bn');
            $table->string('subtitle_2')->nullable()->after('subtitle_1');
            $table->string('subtitle_3')->nullable()->after('subtitle_2');
            $table->json('faqs')->nullable()->after('subtitle_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
