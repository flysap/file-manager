<?php

namespace Flysap\FileManager;

/**
 * List all files relative from core app path ..
 *
 * @param $path
 * @param $view
 * @return mixed
 */
function listFiles($path, $view) {
    $fileManager = app('file-manager');

    return $fileManager
        ->setPath(app_path('../' . $path))
        ->setView($view)
        ->render();
}