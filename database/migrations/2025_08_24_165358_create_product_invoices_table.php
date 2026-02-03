<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');

            // user_id should be nullable
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // fallback customer fields (manual input)
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // Nullable product_id and product_name
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('product_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('product_code')->nullable();

            $table->text('product_description')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('warrenty')->nullable();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('unpaid');
            $table->string('return_status')->default('pending');
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
        Schema::dropIfExists('product_invoices');
    }
}
