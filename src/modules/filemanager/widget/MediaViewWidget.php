<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\filemanager\widget;

use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\modules\filemanager\assets\FileSelectorAsset;
use YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;
use yii\base\Widget;
use yii\widgets\InputWidget;

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: 12/30/2018
 * Time: 4:05 AM
 * @property   ActiveRecord $model
 */
class MediaViewWidget extends Widget
{
    public $model;
    public $attribute;
    public $count;
    public $contentType = ['image', 'video'];

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
//			FileSelectorAsset::register( $this->view );
        if (!empty($this->count)) {

            $medias = GalleryMedias::find()->where(['table_id' => $this->model->id, 'table' => $this->model::tableName(), 'type' => $this->contentType, 'language' => \Yii::$app->Language->contentLanguageID(), 'fieldName' => $this->attribute])->limit($this->count)->all();
        } else {

            $medias = GalleryMedias::find()->where(['table_id' => $this->model->id, 'table' => $this->model::tableName(), 'type' => $this->contentType, 'language' => \Yii::$app->Language->contentLanguageID(), 'fieldName' => $this->attribute])->all();
        }

        if (!empty($medias)) {
            echo $this->render(
                '@system/modules/gallery/widgets/views/widgetImageVideoView.php',
                [
                    'model' => $medias,
                    'attribute' => $this->attribute,
                    'id' => $this->attribute,
                    'count' => $this->count
                ]
            );
        }


    }
}
