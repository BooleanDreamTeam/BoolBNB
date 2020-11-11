<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartaments', function (Blueprint $table) {
            
            $table->id();
            $table->BigInteger('host_id')->unsigned();
            $table->string('title');
            $table->tinyInteger('n_rooms');
            $table->tinyInteger('n_beds');
            $table->tinyInteger('n_bathrooms');
            $table->smallInteger('squaremeters');
            $table->float('latitude', 8, 4);
            $table->float('longitude', 8, 4);
            $table->boolean('is_active');
            $table->timestamps();

            // COLLEGAMENTI
            $table->foreign('host_id')
            ->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appartaments');
    }
}
