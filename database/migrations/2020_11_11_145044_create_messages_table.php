<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id()->unsigned();

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')
            ->on('apartments')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('message');
            $table->string('email');
            $table->dateTime('created_at', 0)->default(DB::raw('CURRENT_TIMESTAMP'));;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
