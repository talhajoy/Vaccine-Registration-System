<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('vaccination_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vaccine_id')->constrained()->onDelete('cascade');
            $table->foreignId('vaccine_center_id')->constrained()->onDelete('cascade');
            $table->date('vaccination_date');
            $table->time('vaccination_time');
            $table->string('batch_number');
            $table->integer('dose_number');
            $table->string('administered_by');
            $table->text('side_effects')->nullable();
            $table->date('next_dose_due')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccination_records');
    }
}
