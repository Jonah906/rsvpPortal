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
        Schema::create('high_impact_deliverables', function (Blueprint $table) {
            $table->id();
            $table->string('Ministry');
            $table->string('Priority Area');
            $table->string('Outcome');
            $table->string('Deliverable');
            $table->string('Type of Baseline(2023 Annual or Q4 2023)');
            $table->string('Baseline(2023)');
            $table->string('Q1 2024 Target');
            $table->string('Q1 2024 Actual');
            $table->string('Q1 2024 cumulative');
            $table->string('Q2 2024 Target');
            $table->string('Q2 2024 Actual');
            $table->string('Q2 Cummulative Actual');
            $table->string('Q3 2024 Target');
            $table->string('Q3 2024 Actual');
            $table->string('Q3 2024 cumulative');
            $table->string('Q4 2024 Target');
            $table->string('2024 Annual Target');
            $table->string('2025 Target');
            $table->string('2026 Target');
            $table->string('2027 Target');
            $table->string('Responsible Dept/Agency');
            $table->string('Type of Supporting Evidence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('high_impact_deliverables');
    }
};
