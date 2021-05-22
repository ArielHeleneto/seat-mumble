<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMumbleUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mumble_user_settings', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->char('username', 254);
            $table->char('password', 254)->default('12345678');
            $table->char('nickname', 254)->nullable();
            $table->char('certhash', 254)->nullable();
            $table->timestamps();
            $table->primary(['id','username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mumble_user_settings');
    }
}
