<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'user_id' );
            $table->integer( 'assigned_to' );
            $table->string( 'name' );
            $table->string( 'color' );
            $table->text( 'description' )->nullable();
            $table->boolean( 'deleted' )->default( false );
            $table->datetime( 'ends_at' );
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
        Schema::dropIfExists('projects');
    }
}
