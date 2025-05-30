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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->nullable()->index('user_id');
            $table->bigInteger('barber_id')->nullable();
            $table->bigInteger('service_id')->nullable()->index('service_id');
            $table->bigInteger('branch_id')->nullable()->index('branch_id');
            $table->dateTime('appointment_time')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->nullable();
            $table->enum('payment_status', ['unpaid', 'paid'])->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_free')->nullable()->default(false);
            $table->bigInteger('promotion_id')->nullable()->index('promotion_id');
            $table->decimal('discount_amount', 10)->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();

            $table->unique(['barber_id', 'branch_id', 'appointment_time'], 'barber_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
