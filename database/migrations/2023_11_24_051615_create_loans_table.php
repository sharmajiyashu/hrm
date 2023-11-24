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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_id');
            $table->string('type')->default(1);
            $table->bigInteger('user_id')->nullable();
            $table->float('loan_amount')->default(0);
            $table->string('tenure')->nullable();
            $table->float('emi')->default(0);
            $table->float('interest_amount')->default(0);
            $table->float('total_amount_paid')->default(0);
            $table->string('rate_of_interest')->default(0);
            $table->date('start_emi')->nullable();
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
        Schema::dropIfExists('loans');
    }
};
