<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('contract_status', ['not_generated', 'sent', 'signed', 'rejected'])
                ->default('not_generated')
                ->after('visa_notes');
            $table->date('contract_date')->nullable()->after('contract_status');
            $table->string('contract_file')->nullable()->after('contract_date');
            $table->text('contract_notes')->nullable()->after('contract_file');
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
