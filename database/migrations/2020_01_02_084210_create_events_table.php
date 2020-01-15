<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('entity_id');
            $table->string('event_picture');
            $table->string('event_name');
            $table->string('registration_link');
            $table->text('description');
            $table->timestamp('application_start_datetime')->nullable();
            $table->timestamp('application_end_datetime')->nullable();
            $table->float('latitude', 10, 8);
            $table->float('longitude', 10, 8);
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
        Schema::dropIfExists('events');
    }
}
