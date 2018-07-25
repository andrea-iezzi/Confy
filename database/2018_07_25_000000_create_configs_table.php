<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');

            $table->string('key');
            $table->string('category');

            $table->longText('data');

            $table->boolean('isJson');

            $table->timestamps();
        });
    }

    /**
     * Reverse the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
