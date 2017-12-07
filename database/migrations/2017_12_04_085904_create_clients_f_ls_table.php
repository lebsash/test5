<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsFLsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_f_ls', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name',30);
            $table->string('surname', 30);
            $table->string('patronimic', 30);
            $table->string('bankAccount',50)->unique();
            $table->string('livingAddress',2048);
            $table->timestamps();
            $table->index(['name', 'surname', 'patronimic', 'id', 'bankAccount']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_f_ls');
    }
}
