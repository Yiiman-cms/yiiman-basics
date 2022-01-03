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
 * Validate Upload Media Type
 * This class validates an upload's media type (e.g. "image/png").
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   1.0.0
 * @package Upload
 */
class Mimetype implements \Upload\ValidationInterface
{
    /**
     * Valid media types
     * @var array
     */
    protected $mimetypes;

    /**
     * Constructor
     * @param  string|array  $mimetypes
     */
    public function __construct($mimetypes)
    {
        if (is_string($mimetypes) === true) {
            $mimetypes = [$mimetypes];
        }
        $this->mimetypes = $mimetypes;
    }

    /**
     * Validate
     * @param  \Upload\FileInfoInterface  $fileInfo
     * @throws \RuntimeException          If validation fails
     */
    public function validate(\Upload\FileInfoInterface $fileInfo)
    {
        if (in_array($fileInfo->getMimetype(), $this->mimetypes) === false) {
            throw new \Upload\Exception(sprintf('Invalid mimetype. Must be one of: %s',
                implode(', ', $this->mimetypes)), $fileInfo);
        }
    }
}
