<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->id();
            $table->string('genderPreference', 191)->nullable();
            $table->integer('duration')->nullable();
            $table->string('providerId')->nullable();
            $table->bigInteger('appointmentId')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('startDateTime')->nullable();
            $table->dateTime('endDateTime')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('staffRequested')->nullable();
            $table->integer('programId')->nullable();
            $table->integer('sessionTypeId')->nullable();
            $table->integer('locationId')->nullable();
            $table->integer('staffId')->nullable();
            $table->bigInteger('clientId')->nullable();
            $table->boolean('firstAppointment')->nullable();
            $table->integer('clientServiceId')->nullable();
            $table->string('addOns')->nullable();
            $table->timestamps();

            $table->foreign('clientId')
                ->onDelete('cascade')
                ->references('clientId')
                ->on('patients');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
