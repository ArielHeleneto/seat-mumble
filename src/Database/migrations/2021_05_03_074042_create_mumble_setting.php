<?php
/*
 * This file is part of SeAT.
 * Copyright (C) 2021 to 2021 Ariel Heleneto.
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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMumbleUserSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mumble_setting', function (Blueprint $table) {
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
        Schema::dropIfexists('mumble_setting');
    }
}
