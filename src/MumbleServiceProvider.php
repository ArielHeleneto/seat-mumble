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

namespace ArielHeleneto\Seat\Mumble;

use Seat\Services\AbstractSeatPlugin;

/**
 * Class mumbleServiceProvider.
 *
 * @package ArielHeleneto\Seat\mumble
 */
class MumbleServiceProvider extends AbstractSeatPlugin
{
    public function boot()
    {
        $this->add_routes();

        $this->add_publications();

        $this->add_views();

        $this->add_translations();

        $this->add_migrations();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/mumble.config.php', 'mumble.config');
        $this->mergeConfigFrom(__DIR__ . '/Config/mumble.locale.php', 'mumble.locale');

        // Overload sidebar with your package menu entries
        $this->mergeConfigFrom(__DIR__ . '/Config/Menu/package.sidebar.php', 'package.sidebar');

        // Register generic permissions
        $this->registerPermissions(__DIR__ . '/Config/Permissions/permission.php', 'mumble');
    }

    /**
     * Include routes.
     */
    private function add_routes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    /**
     * Add content which must be published (generally, configuration files or static ones).
     */
    private function add_publications()
    {
        $this->publishes([
            __DIR__ . '/resources/css' => public_path('mumble/css'),
            __DIR__ . '/resources/img' => public_path('mumble/img'),
            __DIR__ . '/resources/js' => public_path('mumble/js'),
        ], ['public', 'seat']);
    }

    /**
     * Import translations.
     */
    private function add_translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'mumble');
    }

    /**
     * Import views.
     */
    private function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mumble');
    }

    /**
     * Import database migrations.
     */
    private function add_migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @return string
     * @example SeAT Web
     *
     */
    public function getName(): string
    {
        return 'Mumble Management';
    }

    /**
     * Return the plugin repository address.
     *
     * @example https://github.com/eveseat/web
     *
     * @return string
     */
    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/ArielHeleneto/seat-mumble';
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @return string
     * @example web
     *
     */
    public function getPackagistPackageName(): string
    {
        return 'seat-mumble';
    }

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @return string
     * @example eveseat
     *
     */
    public function getPackagistVendorName(): string
    {
        return 'Ariel Heleneto';
    }

    /**
     * Return the plugin installed version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return '0.0.1-dev';
    }
}
