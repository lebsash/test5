<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControncatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controncats', function (Blueprint $table) {
            $table->bigInteger('idcats');
            $table->string('numOfContract', 50);
            $table->timestamps();
            $table->index(['idcats', 'numOfContract']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controncats');
    }
}
