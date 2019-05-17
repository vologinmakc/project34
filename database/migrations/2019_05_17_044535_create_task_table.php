<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('task_body');
            $table->integer('user_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('file')->nullable();
            $table->enum('status', ['WORK', 'CLOSE', 'SUCCESS', 'PAYMENT', 'CREATED'])->default('CREATED');
            $table->integer('create_user_id');
            $table->enum('priority', ['HIGH', 'NORMAL', 'LOW'])->default('NORMAL');
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
        Schema::dropIfExists('task');
    }
}
