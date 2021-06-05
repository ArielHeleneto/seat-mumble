<?php
/*
 * This file is part of SeAT.
 * Copyright (C) 2021 to 2021 Ariel Heleneto<xiongjiahui2004@foxmail.com>.
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

namespace ArielHeleneto\Seat\Mumble\Http\Controllers;

use ArielHeleneto\Seat\Mumble\Helpers\Helper;
use Seat\Web\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use ArielHeleneto\Seat\Mumble\Models\mumble_user_setting;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController.
 *
 * @package Author\Seat\YourPackage\Http\Controllers
 */
class MumbleController extends Controller
{

    /**
     * @return array
     */
    public function getCredential(): array
    {
        $now = mumble_user_setting::firstOrCreate(
            ['id' => Auth::id()],
            ['username' => Auth::id(), 'password' => '12345678']
        );
        return [
            'server_addr' => config('mumble.config.mumble_server_add') ?: '127.0.0.1:64738',
            'username' => $now->id,
            'password' => $now->password,
            'certhash' => $now->certhash,
            'nickname' => $now->nickname
        ];
    }

    public function resetPassword(): array
    {
        $now = mumble_user_setting::firstOrCreate(
            ['id' => Auth::id()],
            ['username' => Auth::id()]
        );
        $now->password = Helper::randomString(20);
        $now->save();
        return ['ok' => true];
    }

    public function refresh(): array
    {
        $now = mumble_user_setting::firstOrCreate(
            ['id' => Auth::id()],
            ['username' => Auth::id(), 'password' => '12345678']
        );
        $now->refresh();
        return ['ok' => true];
    }

    public function submit(): array
    {
        $answer = Request::all();
        $now = mumble_user_setting::firstOrCreate(
            ['id' => Auth::id()],
            ['username' => Auth::id(), 'password' => '12345678']
        );
        $now->password = $answer['password'];
        $now->nickname = $answer['nickname'];
        $now->certhash = $answer['certhash'];
        $now->save();
        return ['ok' => true];
    }
}
