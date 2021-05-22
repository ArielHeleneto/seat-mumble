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

        return [
            'server_addr' => config('mumble_server_add') ?: '127.0.0.1:64738',
            'username' => '$group_id',
            'password' => '$mumble_user->password',
            'certhash' => '',
            'nickname' => 'nickname'
        ];
    }

    public function resetPassword(): array
    {

        return ['ok' => true];
    }
}
