<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clientId')->unique();
            $table->string('firstName', 191)->nullable();
            $table->string('lastName', 191)->nullable();
            $table->string('addressLine1', 191)->nullable();
            $table->string('addressLine2', 191)->nullable();
            $table->dateTime('birthDate')->nullable();
            $table->string('email',191)->nullable();
            $table->string('mobilePhone',191)->nullable();
            $table->string('homePhone',191)->nullable();
            $table->string('workPhone',191)->nullable();
//            $table->date('dob');
//            $table->uuid('practiceId');
//            $table->string('deIdentifiedId',191);
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
        Schema::dropIfExists('patients');
    }
}
