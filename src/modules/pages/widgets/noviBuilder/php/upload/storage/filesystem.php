<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Upload\Storage;

/**
 * FileSystem Storage
 * This class uploads files to a designated directory on the filesystem.
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   1.0.0
 * @package Upload
 */
class FileSystem implements \Upload\StorageInterface
{
    /**
     * Path to upload destination directory (with trailing slash)
     * @var string
     */
    protected $directory;

    /**
     * Overwrite existing files?
     * @var bool
     */
    protected $overwrite;

    /**
     * Constructor
     * @param  string  $directory  Relative or absolute path to upload directory
     * @param  bool    $overwrite  Should this overwrite existing files?
     * @throws \InvalidArgumentException            If directory does not exist
     * @throws \InvalidArgumentException            If directory is not writable
     */
    public function __construct($directory, $overwrite = false)
    {
        if (!is_dir($directory)) {
            throw new \InvalidArgumentException('Directory "'.basename($directory).'" does not exist');
        }
        if (!is_writable($directory)) {
            throw new \InvalidArgumentException('Directory "'.basename($directory).'" is not writable');
        }
        $this->directory = rtrim($directory, '/').DIRECTORY_SEPARATOR;
        $this->overwrite = (bool) $overwrite;
    }

    /**
     * Upload
     * @param  \Upload\FileInfoInterface  $file  The file object to upload
     * @throws \Upload\Exception               If overwrite is false and file already exists
     * @throws \Upload\Exception               If error moving file to destination
     */
    public function upload(\Upload\FileInfoInterface $fileInfo)
    {
        $destinationFile = $this->directory.$fileInfo->getNameWithExtension();
        if ($this->overwrite === false && file_exists($destinationFile) === true) {
            throw new \Upload\Exception('Selected File already exists', $fileInfo);
        }

        if ($this->moveUploadedFile($fileInfo->getPathname(), $destinationFile) === false) {
            throw new \Upload\Exception('Selected File could not be moved to final destination.', $fileInfo);
        }
    }

    /**
     * Move uploaded file
     * This method allows us to stub this method in unit tests to avoid
     * hard dependency on the `move_uploaded_file` function.
     * @param  string  $source       The source file
     * @param  string  $destination  The destination file
     * @return bool
     */
    protected function moveUploadedFile($source, $destination)
    {
        return move_uploaded_file($source, $destination);
    }
}
