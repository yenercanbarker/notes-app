<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_do_list_note', function (Blueprint $table) {
            $table->integer('to_do_list_id')->unsigned();
            $table->foreign('to_do_list_id')->references('id')->on('to_do_lists');
            $table->integer('note_id')->unsigned();
            $table->foreign('note_id')->references('id')->on('notes');
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
        Schema::dropIfExists('list_note');
    }
}
