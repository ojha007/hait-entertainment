<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_ticket_id');
            $table->foreign('event_ticket_id')->references('id')->on('event_tickets');
            $table->integer('seat_quantity');
            $table->integer('price');
            $table->text('email');
            $table->text('name');
            $table->text('phone');
            $table->text('payer_id')->nullable();
            $table->text('token_id')->nullable();
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('bookings');
    }
}
