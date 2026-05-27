<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('region')->nullable()->after('phone');
            $table->string('district')->nullable()->after('region');
            $table->string('county')->nullable()->after('district');
            $table->string('subcounty')->nullable()->after('county');
            $table->string('village')->nullable()->after('subcounty');
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
