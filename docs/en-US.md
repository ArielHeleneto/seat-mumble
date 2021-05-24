# SeAT Mumble

This plugin write for [SeAT](https://github.com/eveseat/seat) is providing to your instance a way to manage your Mumble with SeAT using both query and a grant permission system.

## Requirements

//TODO: Add requirements.

## Installation

### Package deployment

#### Bare metal installation

In your seat directory (by default:`/var/www/seat`), type the following:

```shell script
php artisan down
composer require arielheleneto/seat-mumble

php artisan vendor:publish --force --all
php artisan migrate
php artisan up
```

Now, when you log into `SeAT`  **with right Permission(s)**, you should see a `Connector` category in the sidebar.

### Scheduler

Authenticate on your SeAT instance with an admin account.
You can use the built-in administrator user using `php artisan seat:admin:login` which will provide you proper permissions.

On the sidebar, click on `Settings` and then click on `Schedule`.

* add `seat-connector:apply:policies`(recommended every 30 minutes)

In order to grant access to `Identities` section, you must add permission `seat-connector.view` to a role you're assigning to your users.
