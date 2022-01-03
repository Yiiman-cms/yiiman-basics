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
 * Storage Interface
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   2.0.0
 * @package Upload
 */
interface StorageInterface
{
    /**
     * Upload file
     * This method is responsible for uploading an `\Upload\FileInfoInterface` instance
     * to its intended destination. If upload fails, an exception should be thrown.
     * @param  \Upload\FileInfoInterface  $fileInfo
     * @throws \Exception                If upload fails
     */
    public function upload(\Upload\FileInfoInterface $fileInfo);
}
