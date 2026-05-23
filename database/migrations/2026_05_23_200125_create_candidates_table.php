<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('candidates', function (Blueprint $table) {
        $table->id();
        $table->string('full_name')->nullable();
        $table->string('email')->nullable()->unique();
        $table->string('phone')->nullable();
        $table->string('nationality')->nullable();
        $table->string('position_applied')->nullable();
        $table->enum('status', ['pending', 'shortlisted', 'hired', 'rejected'])->default('pending');
        $table->date('date_applied')->default(now());
        $table->text('remarks')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
