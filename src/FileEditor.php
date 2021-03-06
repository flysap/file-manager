<?php

namespace Flysap\FileManager;

use Flysap\FileManager\Exceptions\FileEditorException;
use Flysap\Support\Traits\ElementAttributes;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileEditor {

    use ElementAttributes;

    const DEFAULT_EDITOR = 'codemirror';

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
        $file = app_path('../' . $file);

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
     * Get raw file .
     *
     * @return string
     * @throws FileEditorException
     */
    public function getRawFile() {
        if(! $this->getFile())
            throw new FileEditorException(_("Please set file"));

        $contents = file_get_contents(
            $this->getFile()
        );

        return $contents;
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

        if(! $editor = $this->getEditor())
            $editor = self::DEFAULT_EDITOR;

        $contents = file_get_contents(
            $this->getFile()
        );

        if(! $this->getAttribute('active_theme'))
            $this->setAttribute('active_theme', 'dracula');

        $attributes = $this->getAttributes();

        return view('file-manager::editors.' . $editor . '.edit', compact('contents', 'attributes'));
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
        $path = app_path('../' . $path);

        if(! $this->fileSystem->exists($path))
            throw new FileEditorException(_("Invalid path."));

        return $this->fileSystem
            ->dumpFile($path, $this->getContents());
    }
}