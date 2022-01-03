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
 * FileInfo Interface
 * @author  Josh Lockhart <info@joshlockhart.com>
 * @since   2.0.0
 * @package Upload
 */
interface FileInfoInterface
{
    public function getPathname();

    public function getName();

    public function setName($name);

    public function getExtension();

    public function setExtension($extension);

    public function getNameWithExtension();

    public function getMimetype();

    public function getSize();

    public function getMd5();

    public function getDimensions();

    public function isUploadedFile();
}
