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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->string('user');
            $table->date('next_payment_date');
            $table->string('category');
            $table->string('description');
            $table->tinyInteger('status')->default(0);
            $table->string('payment_cycle');
            $table->integer('createdBy');
            $table->integer('UpdatedBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
