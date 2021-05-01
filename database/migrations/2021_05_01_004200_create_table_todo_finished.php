<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTodoFinished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('todoFinished')) {
            Schema::create('todoFinished', function (Blueprint $table) {
                $table->id();
                $table->string('titulo');
                $table->integer('user_id');
                $table->dateTime('created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todoFinished');
    }
}
