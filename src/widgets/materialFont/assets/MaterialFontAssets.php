<?php
/**
 * Copyright (c) 2018.
 * Author: Tokapps Tm
 * Programmer: gholamreza beheshtian
 * mobile: 09353466620
 * WebSite:http://tokapps.ir
 *
 *
 */

/**
 * Created by PhpStorm.
 * User: amintado
 * Date: 7/24/2018
 * Time: 7:36 PM
 */

namespace YiiMan\YiiBasics\widgets\materialFont\assets;


use yii\web\AssetBundle;

class MaterialFontAssets extends AssetBundle {
	public function init() {
		parent::init();
		$this->sourcePath=realpath( __DIR__.'/files');
	}
	public $css=
		[
			'css/materialdesignicons.css'
		];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];

}
