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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Change 'employee_id' to 'id' for the default primary key
            $table->string('employee_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('department');
            $table->string('phone'); // Change 'integer' to 'string' for phone number
            $table->string('email'); // Change 'blob' to 'string' for email
            $table->string('image')->nullable(); // Change 'blob' to 'string' and add nullable()
            $table->date('birth_date'); // Change 'string' to 'date' for birth date
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
        Schema::dropIfExists('employees');
    }
};
