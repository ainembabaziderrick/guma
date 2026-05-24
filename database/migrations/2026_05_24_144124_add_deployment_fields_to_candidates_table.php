<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeploymentFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('deployment_status', ['not_scheduled', 'scheduled', 'departed', 'arrived', 'cancelled'])
                ->default('not_scheduled')
                ->after('contract_notes');
            $table->date('departure_date')->nullable()->after('deployment_status');
            $table->date('arrival_date')->nullable()->after('departure_date');
            $table->string('flight_number')->nullable()->after('arrival_date');
            $table->string('destination')->nullable()->after('flight_number');
            $table->text('deployment_notes')->nullable()->after('destination');
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
