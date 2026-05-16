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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();

            $table->string('payment_gateway')->default('midtrans');
            $table->string('payment_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('snap_token')->nullable();
            $table->text('redirect_url')->nullable();

            $table->decimal('gross_amount', 12, 2)->default(0);
            $table->string('status')->default('pending');

            $table->timestamp('paid_at')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
