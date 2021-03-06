<?php

/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\redactor;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since  2.0
 */
class RedactorModule extends \yii\base\Module
{
    public $controllerNamespace = 'YiiMan\YiiBasics\widgets\redactor\controllers';
    public $defaultRoute = 'upload';
    public $uploadDir = '@webroot/uploads';
    public $uploadUrl = '@web/uploads';
    public $imageUploadRoute = ['/redactor/upload/image'];
    public $fileUploadRoute = ['/redactor/upload/file'];
    public $imageManagerJsonRoute = ['/redactor/upload/image-json'];
    public $fileManagerJsonRoute = ['/redactor/upload/file-json'];
    public $imageAllowExtensions = [
        'jpg',
        'png',
        'gif',
        'bmp',
        'svg'
    ];
    public $fileAllowExtensions = null;
    public $widgetOptions = [];
    public $widgetClientOptions = [];

    /**
     * @param $fileName
     * @return string
     * @throws InvalidConfigException
     */
    public function getFilePath($fileName)
    {
        return $this->getSaveDir().DIRECTORY_SEPARATOR.$fileName;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function getSaveDir()
    {
        $path = Yii::getAlias($this->uploadDir);
        if (!file_exists($path)) {
            throw new InvalidConfigException('Invalid config $uploadDir');
        }
        if (FileHelper::createDirectory($path.DIRECTORY_SEPARATOR.$this->getOwnerPath(), 0777)) {
            return $path.DIRECTORY_SEPARATOR.$this->getOwnerPath();
        }
    }

    public function getOwnerPath()
    {
        return Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->id;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function getUrl($fileName)
    {
        return Url::to($this->uploadUrl.'/'.$this->getOwnerPath().'/'.$fileName);
    }
}
