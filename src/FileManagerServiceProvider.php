<?php

namespace Flysap\FileManager;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Flysap\Support;

class FileManagerServiceProvider extends Serviceprovider {

    public function boot() {
        $this->loadConfiguration()
            ->loadViews();

        $this->publishes([
            __DIR__.'/../configuration' => config_path('yaml/file-manager'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
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
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'file-manager'
        );

        Support\merge_yaml_config_from(
            config_path('yaml/file-manager/general.yaml') , 'file-manager'
        );

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

