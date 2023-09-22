<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_civil_id');
            $table->integer('current_department_id');
            $table->integer('transfer_deparment_id')->nullable();
            $table->date('date');
            $table->boolean('current_manager_acceptance');
            $table->boolean('general_manager_acceptance');
            $table->boolean('transfer_manager_acceptance');
            $table->string('statas')->nullable();
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
        Schema::dropIfExists('requests');
    }
};
