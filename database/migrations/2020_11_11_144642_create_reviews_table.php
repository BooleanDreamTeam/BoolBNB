<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('id_apartment');
            $table->foreign('id_apartment')->references('id')->on('apartments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('message',250);
            $table->smallInteger('vote');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
