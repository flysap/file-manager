<?php

namespace Flysap\FileManager;

/**
 * List all files relative from core app path ..
 *
 * @param $path
 * @param $view
 * @param array $attributes
 * @return mixed
 */
function listFiles($path, $view, $attributes = array()) {
    $fileManager = app('file-manager');

    return $fileManager
        ->setPath($path)
        ->setView($view)
        ->setAttributes($attributes)
        ->render();
}

/**
 * Edit file ..
 *
 * @param $file
 * @param array $attributes
 * @return mixed
 */
function editFile($file, $attributes = array()) {
    $fileManager = app('file-editor');

    return $fileManager
        ->setFile($file)
        ->setAttributes($attributes)
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