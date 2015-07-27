<?php

namespace Flysap\FileManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

class FileManagerServiceProvider extends Serviceprovider {

    public function boot() {
        $this->loadConfiguration();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

    }

    /**
     * Load configuration .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        $array = Yaml::parse(file_get_contents(
            __DIR__ . '/../configuration/general.yaml'
        ));

        $config = $this->app['config']->get('file-manager', []);

        $this->app['config']->set('file-manager', array_merge($array, $config));

        return $this;
    }
}

