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

namespace ArielHeleneto\Seat\Mumble\Helpers;

use ArielHeleneto\Seat\Mumble\Models\mumble_user_setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Seat\Eveapi\Models\Corporation\CorporationInfo;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\RefreshToken;
use Seat\Web\Models\User;
use Exception;

/**
 * Class Helper
 * @package WinterCo\Connector\Mumble\Helpers
 */
class Helper
{

    public const NICKNAME_LENGTH_LIMIT = 64;


    /**
     * Filter character id that have a valid refresh token.
     *
     * @param Collection $characterIDs
     * @return array
     */
    public static function getEnabledKey(Collection $users): array
    {
        // retrieve character ids with a valid refresh token
        return RefreshToken::whereIn('character_id', $users->pluck('id')->toArray())->pluck('character_id')->toArray();
    }


    /**
     * Return a string which will be used as a Discord Guild Member Nickname
     *
     * @param MumbleUser $mumble_user
     * @return string
     * @throws \Seat\Services\Exceptions\SettingException
     */
    public static function buildNickname(User $mumble_user): string
    {
        $character = CharacterInfo::where('character_id', $mumble_user->main_character_id)->first();
        if (is_null($character)) {
            throw new Exception('Unable to get Character');
        }
        $corporation_id = $character->corporation_history()->first()->corporation_id;
        $corporation = CorporationInfo::where('corporation_id', $corporation_id)->first();
        // init the discord nickname to the character name
        $expected_nickname = $character->name;
        $user_nickname =  mumble_user_setting::find($mumble_user->id)->nickname;
        $expected_nickname = is_null($user_nickname) ? $expected_nickname : $user_nickname . '/' . $expected_nickname;

        $expected_nickname = sprintf('[%s] %s', $corporation ? $corporation->ticker : '????', $expected_nickname);
        return Str::limit($expected_nickname, Helper::NICKNAME_LENGTH_LIMIT, '');
    }

    public static function randomString(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}
