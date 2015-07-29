<?php

namespace Flysap\FileManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class FileManagerServiceProvider extends Serviceprovider {

    public function boot() {
        $this->loadConfiguration()
            ->loadViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('file-service', function() {
            return new FileService;
        });

        $this->app->singleton('file-manager', function() {
           return new FileManager(
               new Filesystem(), new Finder()
           );
        });

        $this->app->singleton('file-editor', function() {
            return new FileEditor(
                new Filesystem(), new Finder()
            );
        });
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

    /**
     * Load views.
     *
     * @return $this
     */
    protected function loadViews() {
        $this->loadViewsFrom(__DIR__ . '/../views', 'file-manager');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/administrator'),
        ]);

        return $this;
    }
}

