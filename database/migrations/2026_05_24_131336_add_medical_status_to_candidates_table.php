<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalStatusToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('medical_status', ['not_scheduled', 'scheduled', 'passed', 'failed'])
                ->default('not_scheduled')
                ->after('status');
            $table->date('medical_date')->nullable()->after('medical_status');
            $table->text('medical_notes')->nullable()->after('medical_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
        });
    }
}
