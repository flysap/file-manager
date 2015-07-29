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
    $fileEditor = app('file-editor');

    return $fileEditor
        ->setFile($file)
        ->setAttributes($attributes)
        ->render();
}

/**
 * Get raw file ..
 *
 * @param $file
 * @return mixed
 */
function getFile($file) {
    $fileEditor = app('file-editor');

    return $fileEditor
        ->setFile($file)
        ->getRawFile();
}

/**
 * Update file .
 *
 * @param $file
 * @param $contents
 * @return mixed
 */
function updateFile($file, $contents) {
    $fileEditor = app('file-editor');

    return $fileEditor
        ->setContent($contents)
        ->update($file);
}