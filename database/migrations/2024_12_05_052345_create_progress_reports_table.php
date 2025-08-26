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
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->string('Ministry');
            $table->string('Priority Area');
            $table->string('Outcome');
            $table->string('Deliverable');
            $table->string('Indicator');
            $table->string('Target(Expected Milestones)');
            $table->string('Progress(Achieved Milestones)');
            $table->string('Key Issues(Challenges)');
            $table->string("MDA's Effort to resolve Issues");
            $table->string('Comment(Support Required)');
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
        Schema::dropIfExists('progress_reports');
    }
};
