<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMumbleServerDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mumble_server_data', function (Blueprint $table) {
            $table->integer('user_id');
            $table->char('username', 254);
            $table->char('password', 254)->default('12345678');
            $table->longtext('groups')->nullable();
            $table->char('display_name', 254)->default('12345678');
            $table->char('cert_hash', 254)->nullable();
            $table->primary(['user_id','username']);
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
        Schema::dropIfExists('mumble_server_data');
    }
}
