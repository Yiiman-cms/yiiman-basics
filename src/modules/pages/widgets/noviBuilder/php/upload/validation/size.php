<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Upload\Validation;

/**
 * Validate Upload File Size
 * This class validates an uploads file size using maximum and (optionally)
 * minimum file size bounds (inclusive). Specify acceptable file sizes
 * as an integer (in bytes) or as a human-readable string (e.g. "5MB").
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   1.0.0
 * @package Upload
 */
class Size implements \Upload\ValidationInterface
{
    /**
     * Minimum acceptable file size (bytes)
     * @var int
     */
    protected $minSize;

    /**
     * Maximum acceptable file size (bytes)
     * @var int
     */
    protected $maxSize;

    /**
     * Constructor
     * @param  int  $maxSize  Maximum acceptable file size in bytes (inclusive)
     * @param  int  $minSize  Minimum acceptable file size in bytes (inclusive)
     */
    public function __construct($maxSize, $minSize = 0)
    {
        if (is_string($maxSize)) {
            $maxSize = \Upload\File::humanReadableToBytes($maxSize);
        }
        $this->maxSize = $maxSize;

        if (is_string($minSize)) {
            $minSize = \Upload\File::humanReadableToBytes($minSize);
        }
        $this->minSize = $minSize;
    }

    /**
     * Validate
     * @param  \Upload\FileInfoInterface  $fileInfo
     * @throws \RuntimeException          If validation fails
     */
    public function validate(\Upload\FileInfoInterface $fileInfo)
    {
        $fileSize = $fileInfo->getSize();

        if ($fileSize < $this->minSize) {
            throw new \Upload\Exception(sprintf('File size is too small. Must be greater than or equal to: %s',
                $this->minSize), $fileInfo);
        }

        if ($fileSize > $this->maxSize) {
            throw new \Upload\Exception(sprintf('File size is too large. Must be less than: %s', $this->maxSize),
                $fileInfo);
        }
    }
}
