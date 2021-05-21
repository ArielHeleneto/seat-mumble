<?php

/**
 * This file is part of SeAT Mumble Connector.
 *
 * Copyright (C) 2021 Ariel Heleneto <xiongjiahui2004@foxmail.com>
 *
 * SeAT Mumble Connector is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * SeAT Mumble Connector is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace ArielHeleneto\Seat\Connector\Drivers\Mumble;

use Seat\Services\AbstractSeatPlugin;

/**
 * Class MumbleConnectorServiceProvider.
 *
 * @package ArielHeleneto\Seat\Connector\Drivers\Mumble
 */
class MumbleConnectorServiceProvider extends AbstractSeatPlugin
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addRoutes();
        $this->addViews();
        $this->addTranslations();
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations/');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/mumble.config.php', 'mumble.config');

        $this->mergeConfigFrom(
            __DIR__ . '/Config/seat-connector.config.php', 'seat-connector.drivers.mumble');
    }

    private function addRoutes()
    {
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }

    private function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'seat-connector-mumble');
    }

    private function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'seat-connector-mumble');
    }

    /**
     * Return an URI to a CHANGELOG.md file or an API path which will be providing changelog history.
     *
     * @example https://raw.githubusercontent.com/eveseat/seat/master/LICENSE
     * @exemple https://api.github.com/repos/eveseat/web/releases
     *
     * @return string|null
     */
    public function getChangelogUri(): ?string
    {
        return 'https://raw.githubusercontent.com/arielheleneto/seat-mumble/master/CHANGELOG.md';
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @example SeAT Web
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Mumble Connector';
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
        return 'https://github.com/arielheleneto/seat-mumble';
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @example web
     *
     * @return string
     */
    public function getPackagistPackageName(): string
    {
        return 'seat-mumble';
    }

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @example eveseat
     *
     * @return string
     */
    public function getPackagistVendorName(): string
    {
        return 'ArielHeleneto';
    }
}
