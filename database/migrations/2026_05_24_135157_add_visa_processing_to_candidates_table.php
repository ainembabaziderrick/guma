<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisaProcessingToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('visa_status', ['not_started', 'submitted', 'approved', 'rejected', 'issued'])
                ->default('not_started')
                ->after('police_notes');
            $table->date('visa_date')->nullable()->after('visa_status');
            $table->text('visa_notes')->nullable()->after('visa_date');
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
