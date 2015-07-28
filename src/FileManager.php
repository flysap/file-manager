<?php

namespace Flysap\FileManager;

use Flysap\FileManager\Exceptions\FileManagerException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileManager {

    const VIEW_PATH = 'views';

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

    /**
     * @var
     */
    protected $view;

    public function __construct(FileSystem $fileSystem, Finder $finder) {

        $this->fileSystem = $fileSystem;
        $this->finder = $finder;
    }

    /**
     * Set path .
     *
     * @param $path
     * @throws Exceptions\FileManagerException
     * @return $this
     */
    public function setPath($path) {
        if(! $this->fileSystem->isAbsolutePath($path))
            #throw new FileManagerException(_("Invalid path"));

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

        $this->finder->in(app_path('../') . DIRECTORY_SEPARATOR . $path)
            ->ignoreDotFiles(Finder::IGNORE_DOT_FILES);

        return $this;
    }

    /**
     * List files .
     *
     * @param null $path
     * @return Finder
     * @throws FileManagerException
     */
    public function files($path = null) {
        $this->prepare($path);

        $files = [];
        foreach($this->finder->files() as $file)
            $files[] = $file;

        return $files;
    }

    /**
     * Get directories .
     *
     * @param null $path
     * @return mixed
     * @throws FileManagerException
     */
    public function directories($path = null) {
        $this->prepare($path);

        $directories = [];
        foreach($this->finder->directories()as $directory)
            $directories[] = $directory;

        return $directories;
    }


    /**
     * Set view .
     *
     * @param $path
     * @return $this
     * @throws Exceptions\FileManagerException
     */
    public function setView($path) {
        $this->view = $path;

        return $this;
    }

    /**
     * Get view .
     *
     * @return mixed
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Render list ..
     *
     * @throws Exceptions\FileManagerException
     */
    public function render($files = null) {
        if(! $this->getView())
            throw new FileManagerException(_("Invalid view path."));

        if( ! $files ) {
            foreach($this->files() as $file)
                $files[] = $file;
        }

        return view(
            'file-manager::' . $this->getView(), compact('files')
        );
    }

    /**
     * Render files .
     *
     * @return \Illuminate\View\View
     */
    public function __toString() {
        return $this->render();
    }

}