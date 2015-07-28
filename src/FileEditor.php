<?php

namespace Flysap\FileManager;

use Flysap\FileManager\Exceptions\FileEditorException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileEditor {

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
    protected $file;

    /**
     * @var
     */
    protected $editor;

    /**
     * @var
     */
    protected $content;

    public function __construct(FileSystem $fileSystem, Finder $finder) {

        $this->fileSystem = $fileSystem;
        $this->finder = $finder;
    }

    /**
     * Set file ..
     *
     * @param $file
     * @return $this
     * @throws Exceptions\FileEditorException
     */
    public function setFile($file) {
        if(! $this->fileSystem->exists($file))
            throw new FileEditorException(_("Invalid file path"));

        $this->file = $file;

        return $this;
    }

    /**
     * Get file .
     *
     * @return mixed
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set editor .
     *
     * @param $editor
     * @return $this
     */
    public function setEditor($editor) {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor .
     *
     * @return mixed
     */
    public function getEditor() {
        return $this->editor;
    }

    /**
     * Render .
     *
     * @return string
     * @throws Exceptions\FileEditorException
     */
    public function render() {
        if(! $this->getFile())
            throw new FileEditorException(_("Please set file"));

        $contents = file_get_contents(
            $this->getFile()
        );

        return $contents;
    }

    public function __toString() {
        return $this->render();
    }

    /**
     * Set content .
     *
     * @param $contents
     * @return $this
     */
    public function setContent($contents) {
        $this->content = $contents;

        return $this;
    }

    /**
     * Get content .
     *
     * @return mixed
     */
    public function getContents() {
        return $this->content;
    }

    /**
     * Update file
     *
     * @param $path
     * @throws Exceptions\FileEditorException
     */
    public function update($path) {
        if(! $this->fileSystem->exists($path))
            throw new FileEditorException(_("Invalid path."));

        return $this->fileSystem
            ->dumpFile($path, $this->getContents());
    }
}