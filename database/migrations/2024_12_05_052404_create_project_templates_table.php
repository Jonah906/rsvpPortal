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
        Schema::create('project_templates', function (Blueprint $table) {
            $table->id();
            $table->string('PRIORITY AREA');
            $table->string('DELIVERABLE');
            $table->string('PROJECT/PROGRAMME TITLE');
            $table->string('OBJECTIVE');
            $table->string('BUDGET_CODE');
            $table->string('AMOUNT APPROPRIATED');
            $table->string('TOTAL COST');
            $table->string('CURRENCY');
            $table->string('FOREIGN_COMPONENT');
            $table->string('FUNDING_SOURCE');
            $table->string('PROJECT_TYPE');
            $table->string('PROJECT_STATUS');
            $table->string('STATE');
            $table->string('LGA');
            $table->string('LOCATION');
            $table->string('LONGITUDE');
            $table->string('LATITUDE');
            $table->string('APPROVAL_DATE');
            $table->string('START_DATE');
            $table->string('END_DATE');
            $table->string('CONTRACTOR');
            $table->string('AMOUNT_RELEASED');
            $table->string('AMOUNT_UTILIZED');
            $table->string('PLANNED_MILESTONE');
            $table->string('ACTUAL_MILESTONE');
            $table->string('PERCENTAGE_COMPLETION');
            $table->string('RECOMMENDATIONS');
            $table->string('CHALLENGES');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_templates');
    }
};
