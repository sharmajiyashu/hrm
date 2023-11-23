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
            $table->id();
            $table->string('gender')->nullable();
            $table->string('designation')->nullable();
            $table->float('salary')->default(0);
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->longText('address')->nullable();
            $table->string('county')->default('INDIA');
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_join')->nullable();
            $table->longText('description')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->string('status')->default(1);
            $table->string('user_id')->nullable();
            $table->softDeletes();
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
