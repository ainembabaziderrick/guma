<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Employer;
use App\Models\Agent;

class CreateJobOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            
            $table->foreignIdFor(Employer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Agent::class)->nullable()->constrained()->nullOnDelete();
            
            $table->string('job_title');
            $table->integer('vacancies')->default(1);
            $table->string('location')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('status', ['open', 'closed', 'on_hold'])->default('open');
            $table->date('deadline')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('job_orders');
    }
}
