<?php

namespace Flysap\FileManager;

use Flysap\FileManager\Exceptions\FileManagerException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileManager {

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var
     */
    protected $path;

    public function __construct(FileSystem $fileSystem, Finder $finder) {

        $this->fileSystem = $fileSystem;
        $this->finder = $finder;
    }

    /**
     * Set path .
     *
     * @param $path
     * @return $this
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path .
     *
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Prepare finder .
     *
     * @param null $path
     * @return $this
     * @throws FileManagerException
     */
    public function prepare($path = null) {
        if( is_null($path))
            $path = $this->getPath();

        if( is_null($path))
            throw new FileManagerException(_("Invalid path"));

        $this->finder->in(app_path('../') . DIRECTORY_SEPARATOR . $this->getPath())
            ->ignoreDotFiles(Finder::IGNORE_DOT_FILES);

        return $this;
    }

    /**
     * List files .
     *
     * @param null $path
     * @throws FileManagerException
     */
    public function getFiles($path = null) {
        $this->prepare($path);

        return $this->finder->getFiles();
    }

    /**
     * Get directories .
     *
     * @param null $path
     * @return mixed
     * @throws FileManagerException
     */
    public function getDirectories($path = null) {
        $this->prepare($path);

        return $this->finder->getDirectories();
    }

}