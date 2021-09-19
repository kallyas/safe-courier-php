<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->increments('id');
            //parcel description
            $table->string('description');
            //parcel status
            $table->string('status');
            // location from
            $table->string('from_location');
            // location to
            $table->string('to_location');
            // parcel weight
            $table->integer('weight');
            // parcel price
            $table->integer('price');
            // parcel owner
            $table->integer('owner_id');
            // recipient as object
            $table->string('recipient_name');
            // recipient address
            $table->string('recipient_address');
            // recipient email  
            $table->string('recipient_email');
            // recipient phone
            $table->string('recipient_phone');
            // present location
            $table->string('present_location');
            // pickup location
            $table->string('pickup_location');
            // notes
            $table->text('notes');
            // drop off location
            $table->string('drop_off_location');
            $table->string('tracking_number');
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
        Schema::dropIfExists('parcels');
    }
}
