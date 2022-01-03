<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Upload;

/**
 * Validation Interface
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   2.0.0
 * @package Upload
 */
interface ValidationInterface
{
    /**
     * Validate file
     * This method is responsible for validating an `\Upload\FileInfoInterface` instance.
     * If validation fails, an exception should be thrown.
     * @param  \Upload\FileInfoInterface  $fileInfo
     * @throws \Exception                If validation fails
     */
    public function validate(\Upload\FileInfoInterface $fileInfo);
}
