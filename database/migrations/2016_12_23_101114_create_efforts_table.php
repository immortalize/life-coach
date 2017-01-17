<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEffortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efforts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goal_id');
            $table->text('desc');
            $table->timestamp('start_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_time')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('efforts');
    }
}
