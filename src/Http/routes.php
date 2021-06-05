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

Route::group([
    'namespace' => 'ArielHeleneto\Seat\Mumble\Http\Controllers',
    'middleware' => ['web', 'auth', 'locale'],
    'prefix' => 'mumble',
], function () {

    // Menu & Views
    Route::get('/account', [
        'as' => 'mumble.view',
        'uses' => 'UserController@getAccount',
        'middleware' => 'can:mumble.view',
    ]);

    //Account
    Route::group([
        'middleware' => ['web', 'auth', 'locale'],
    ], function () {

        Route::group([
            'middleware' => 'can:mumble.view',
        ], function () {

            Route::get('/credentials', [
                'as' => 'mumble.account.getCredential',
                'uses' => 'MumbleController@getCredential',
            ]);

            Route::get('/reset', [
                'as' => 'mumble.account.reset',
                'uses' => 'MumbleController@resetPassword',
            ]);

            Route::get('/refresh', [
                'as' => 'mumble.account.refresh',
                'uses' => 'MumbleController@refresh',
            ]);

        });
    });
});
