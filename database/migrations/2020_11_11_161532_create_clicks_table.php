<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('id_apartment');
            $table->foreign('id_apartment')->references('id')->on('apartments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('browser');
            $table->string('geo_area');
            $table->ipAddress('visitor');
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
        Schema::dropIfExists('clicks');
    }
}
