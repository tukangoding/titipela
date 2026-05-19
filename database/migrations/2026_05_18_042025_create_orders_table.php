<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('batch_id')->nullable()->constrained();
        $table->string('order_code')->unique();
        $table->string('customer_name');
        $table->string('wa_number');
        $table->text('address');
        $table->string('city');
        $table->boolean('is_cod')->default(false);
        $table->boolean('cod_outside_area')->default(false);
        $table->string('shipping_method'); // jne_reguler, jne_express, cod
        $table->integer('shipping_cost');
        $table->integer('service_fee');
        $table->integer('total');
        $table->enum('status', [
            'pending_payment',
            'processing',
            'buying',
            'shipped',
            'done',
            'cancelled'
        ])->default('pending_payment');
        $table->string('tracking_number')->nullable();
        $table->string('midtrans_snap_token')->nullable();
        $table->string('midtrans_transaction_id')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
