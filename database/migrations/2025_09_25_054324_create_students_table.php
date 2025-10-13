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
        Schema::create('students', function (Blueprint $table) {
           $table->id();
            
            $table->string('student_photo'); 
            $table->string('student_signature');
            
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            
            $table->string('first_name_dev');
            $table->string('middle_name_dev')->nullable();
            $table->string('last_name_dev');

            $table->string('father_name');
            $table->string('mother_name');

            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('marital_status', ['Married', 'Unmarried']);

            $table->string('date_of_birth_bs'); 
            $table->date('date_of_birth_ad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
