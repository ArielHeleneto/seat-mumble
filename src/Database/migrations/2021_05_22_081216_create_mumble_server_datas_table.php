<?php
/*
 * This file is part of SeAT.
 * Copyright (C) 2021 to 2021 Ariel Heleneto<ArielHeleneto@outlook.com>.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->primary(['user_id', 'username']);
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
