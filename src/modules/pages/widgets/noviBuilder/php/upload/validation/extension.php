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
 * Validate File Extension
 * This class validates an uploads file extension. It takes file extension with out dot
 * or array of extensions. For example: 'png' or array('jpg', 'png', 'gif').
 * WARNING! Validation only by file extension not very secure.
 * @author  Alex Kucherenko <kucherenko.email@gmail.com>
 * @package Upload
 */
class Extension implements \Upload\ValidationInterface
{
    /**
     * Array of acceptable file extensions without leading dots
     * @var array
     */
    protected $allowedExtensions;

    /**
     * Constructor
     * @param  string|array  $allowedExtensions  Allowed file extensions
     * @example new \Upload\Validation\Extension(array('png','jpg','gif'))
     * @example new \Upload\Validation\Extension('png')
     */
    public function __construct($allowedExtensions)
    {
        if (is_string($allowedExtensions) === true) {
            $allowedExtensions = [$allowedExtensions];
        }

        $this->allowedExtensions = array_map('strtolower', $allowedExtensions);
    }

    /**
     * Validate
     * @param  \Upload\FileInfoInterface  $fileInfo
     * @throws \RuntimeException         If validation fails
     */
    public function validate(\Upload\FileInfoInterface $fileInfo)
    {
        $fileExtension = strtolower($fileInfo->getExtension());

        if (in_array($fileExtension, $this->allowedExtensions) === false) {
            throw new \Upload\Exception(sprintf('Invalid file extension. Must be one of: %s',
                implode(', ', $this->allowedExtensions)), $fileInfo);
        }
    }
}
