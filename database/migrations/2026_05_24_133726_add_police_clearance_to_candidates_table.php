<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoliceClearanceToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('police_status', ['not_submitted', 'submitted', 'cleared', 'flagged'])
                ->default('not_submitted')
                ->after('medical_notes');
            $table->date('police_date')->nullable()->after('police_status');
            $table->text('police_notes')->nullable()->after('police_date');
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
