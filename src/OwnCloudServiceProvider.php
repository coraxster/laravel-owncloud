<?php

namespace League\Flysystem\OwnCloud;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Sabre\DAV\Client as WebDAVClient;

class OwnCloudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make('filesystem')->extend(
            'owncloud',
            function (Container $app, array $config) {
                $client = new WebDAVClient($config);
                $options = isset($config['curl_options']) ? $config['curl_options'] : [];
                foreach ($options as $key => $value) {
                    $client->addCurlSetting($key, $value);
                }
                $adapter = new OwnCloudAdapter($client,
                    null,
                    true, [
                    'shareApi' => $config['shareApi'],
                    'userName' => $config['userName'],
                    'password' => $config['password']
                ]);
                return new Filesystem($adapter);
            }
        );
    }

    public function register()
    {
    }
}
