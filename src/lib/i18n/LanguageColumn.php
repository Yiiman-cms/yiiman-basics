<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\i18n;


use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\lib\Core;
use YiiMan\YiiBasics\modules\language\models\Language;
use yii\grid\Column;
use yii\helpers\ArrayHelper;

class LanguageColumn extends Column
{
    public static $languages;
    public $header = '';

    public function __construct($config = [])
    {
        $this->header = \Yii::t('backend', 'Languages');
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if (!Core::$enabledLanguage) {
            return '';
        }

        /**
         * @var $model ActiveRecord
         */
        if (!$model->hasLanguage) {
            return '';
        }
        /**
         * @var $model ActiveRecord
         * @var $class ActiveRecord
         */
        $class = $model::className();
        if (empty(self::$languages)) {
            self::$languages = Language::find()->where(['status' => Language::STATUS_ACTIVE])->all();
            self::$languages = ArrayHelper::map(self::$languages, 'id', 'image');
        }
        $html = '<div class="availableLanguagesForIndex">';
        if (empty($model->language_parent)) {
            $parent = self::$languages[$model->language];
            $langModel = new Language();
            $langModel->image = $parent;
            $langModel->id = $model->language;

            $html .= '<img src="'.\Yii::$app->UploadManager->getImageUrl($langModel, 'image', '30*30').'" >';

            $other = $class::find()->where(['language_parent' => $model->id])->all();
            if (!empty($other)) {
                foreach ($other as $item) {
                    $langModel->image = self::$languages[$item->language];
                    $langModel->id = $item->language;
                    $html .= '<img src="'.\Yii::$app->UploadManager->getImageUrl($langModel, 'image', '30*30').'" >';
                }
            }
        } else {
            $parent = $class::findOne($model->language_parent);
            $parentID = $parent->id;
            $parentLanguageId = $parent->language;
            $parent = self::$languages[$parent->language];
            $langModel = new Language();
            $langModel->image = $parent;
            $langModel->id = $parentLanguageId;
            $html .= '<img src="'.\Yii::$app->UploadManager->getImageUrl($langModel, 'image', '30*30').'" >';

            $other = $class::find()->where(['language_parent' => $parentID])->all();
            if (!empty($other)) {
                foreach ($other as $item) {
                    $langModel->image = self::$languages[$item->language];
                    $langModel->id = $item->language;
                    $html .= '<img src="'.\Yii::$app->UploadManager->getImageUrl($langModel, 'image', '30*30').'" >';
                }
            }
        }


        $html .= '</div>';

        return $html;
    }
}
