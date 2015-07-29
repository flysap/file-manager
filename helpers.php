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
        ->setPath($path)
        ->setView($view)
        ->render();
}

/**
 * Edit file ..
 *
 * @param $file
 * @return mixed
 */
function editFile($file) {
    $fileManager = app('file-editor');

    return $fileManager
        ->setFile($file)
        ->render();
}

/**
 * Update file .
 *
 * @param $file
 * @param $contents
 * @return mixed
 */
function updateFile($file, $contents) {
    $fileManager = app('file-editor');

    return $fileManager
        ->setContent($contents)
        ->update($file);
}