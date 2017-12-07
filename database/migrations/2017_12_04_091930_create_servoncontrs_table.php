<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServoncontrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servoncontrs', function (Blueprint $table) {
            $table->string('NumOfContract', 50);
            $table->integer('NumOfService');
            $table->timestamps();
            $table->index(['NumOfContract', 'NumOfService']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servoncontrs');
    }
}
