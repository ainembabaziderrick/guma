<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostDeploymentFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('post_deployment_status', ['not_started', 'in_probation', 'confirmed', 'terminated'])
                ->default('not_started')
                ->after('deployment_notes');
            $table->date('probation_end_date')->nullable()->after('post_deployment_status');
            $table->date('last_followup_date')->nullable()->after('probation_end_date');
            $table->text('post_deployment_notes')->nullable()->after('last_followup_date');
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
