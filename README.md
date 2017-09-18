# laravel-owncloud

## Install

Via Composer

``` bash
$ composer require coraxster/laravel-owncloud
```

## Usage

Register the service provider in your app.php config file:

``` php
// config/app.php

'providers' => [
    ...
    League\Flysystem\OwnCloud\OwnCloudServiceProvider::class
    ...
];
```

Create a owncloud filesystem disk:

``` php
// config/filesystems.php

'disks' => [
	...
	'owncloud' => [
        'driver'   => 'owncloud',
        'baseUri'  => 'webdav.url',
        'shareApi'  => 'something like...ocs/v1.php/apps/files_sharing/api/v1/shares',
        'userName' => 'secret',
        'password' => 'secret'
    ],
	...
];
```