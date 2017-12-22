<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'user_id' );
            $table->integer( 'project_id' );
            $table->string( 'name' );
            $table->text( 'description' )->nullable();
            $table->boolean( 'completed' )->default( false );
            $table->boolean( 'scheduled' )->default( false );
            $table->boolean( 'deleted' )->default( false );
            $table->datetime( 'ends_at' )->nullable();
            $table->datetime( 'completed_at' )->nullable();
            $table->integer( 'completed_by' )->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
