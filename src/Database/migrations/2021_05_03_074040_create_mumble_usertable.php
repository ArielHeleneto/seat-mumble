<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMumbleUsertable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mumble_mumbleuser', function (Blueprint $table) {
            $table->integer('user_id');
            $table->char('username', 254);
            $table->char('pwhash', 254);
            $table->longtext('groups')->nullable();
            $table->char('hashfn', 20);
            $table->char('display_name', 254);
            $table->char('cert_hash', 254)->nullable();
            $table->primary(['user_id','username','display_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfexists('mumble_mumbleuser');
    }
}
