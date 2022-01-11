<?php
/**
 * Copyright (c) 2008-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

use Yii;
use yii\base\Component;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * AssetManager manages asset bundle configuration and loading.
 *
 * AssetManager is configured as an application component in [[\yii\web\Application]] by default.
 * You can access that instance via `Yii::$app->assetManager`.
 *
 * You can modify its configuration by adding an array to your application config under `components`
 * as shown in the following example:
 *
 * ```php
 * 'assetManager' => [
 *     'bundles' => [
 *         // you can override AssetBundle configs here
 *     ],
 * ]
 * ```
 *
 * For more details and usage information on AssetManager, see the [guide article on assets](guide:structure-assets).
 *
 * @property AssetConverterInterface $converter The asset converter. Note that the type of this property
 * differs in getter and setter. See [[getConverter()]] and [[setConverter()]] for details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AssetManager extends \yii\web\AssetManager
{

    /**
     * Initializes the component.
     * @throws InvalidConfigException if [[basePath]] does not exist.
     */
    public function init()
    {
        $this->basePath = Yii::getAlias($this->basePath);
        if (!realpath($this->basePath)) {
            @mkdir($this->basePath,0777,true);
        }
        $this->basePath = realpath($this->basePath);
        $this->baseUrl = rtrim(Yii::getAlias($this->baseUrl), '/');
    }

}
