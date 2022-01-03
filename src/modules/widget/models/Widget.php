<?php

namespace YiiMan\YiiBasics\modules\widget\models;

use Guzzle\Service\Description\Parameter;
use YiiMan\YiiBasics\lib\Model;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\parameters\models\Parameters;
use Yii;
use yii\db\conditions\ExistsCondition;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_widget}}".
 *
 * @property int $id
 * @property string $content
 * @property string $shortCode
 * @property int $language
 * @property int $language_parent
 * @property string $title
 *
 * @property Language $language0
 * @property Widget $languageParent
 * @property Widget[] $widgets
 */
class Widget extends \YiiMan\YiiBasics\lib\ActiveRecord
{

    public static $locations = [];

    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_widget}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'shortCode', 'title'], 'required'],
            [['content'], 'string'],
            [['language', 'language_parent'], 'integer'],
            [['shortCode', 'title'], 'string', 'max' => 255],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\language\models\Language::className(), 'targetAttribute' => ['language' => 'id']],
            [['language_parent'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\widget\models\Widget::className(), 'targetAttribute' => ['language_parent' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('widget', 'شناسه'),
            'content' => Yii::t('widget', 'محتوا'),
            'shortCode' => Yii::t('widget', 'کد موقعیت'),
            'language' => Yii::t('widget', 'زبان'),
            'language_parent' => Yii::t('widget', 'زبان مادر'),
            'title' => Yii::t('widget', 'عنوان'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0()
    {
        return $this->hasOne(Language::className(), ['id' => 'language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageParent()
    {
        return $this->hasOne(Widget::className(), ['id' => 'language_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgets()
    {
        return $this->hasMany(Widget::className(), ['language_parent' => 'id']);
    }

    /**
     * آرایه ای از مکان هایی که در قالب تعریف میکنید تشکیل دهید تا در بک اند و در منوی ویجت ها قابل نمایش و قابل تنظیم باشد.
     *
     * کاربر میتواند محتوای این ویجت ها را تغییر دهد و آنها را در مکان مورد نظر فعال یا غیر فعال کند
     *
     * نمونه ی آرایه:
     *
     *
     * [
     *      'key'=>'label',
     *      'key'=>'label',
     * ]
     *
     * @param $array
     */
    public static function addLocations($array)
    {
        foreach ($array as $key => $label) {
            self::$locations[$key] = $label;
        }
    }


    public static function getLoadedWidget()
    {
        $all = self::getLocations();
        $models = self::find()->select(['shortCode', 'id'])->where(['language'=>Yii::$app->Language->contentLanguageID()])->asArray()->all();

        if (empty($models)) {
            return [];
        } else {
            $actives = [];
            $models = ArrayHelper::map($models, 'shortCode', 'id');
            foreach ($all as $shortCode => $label) {
                if (!empty($models[$shortCode])){
                    $actives[$shortCode]=$label;
                }
            }

            return $actives;
        }

    }

    public static function disabledItemsSelect2(){
        $data=self::getLoadedWidget();
        $out=[];
        if (!empty($data)){
            foreach ($data as $key=>$label){
                $out[$key]=['disabled' => true];
            }
        }
        return $out;
    }

    /**
     * دریافت همه ی مکان های ویجت به صورت یکجا
     * @return array
     */
    public static function getLocations()
    {
        return self::$locations;
    }

    /**
     * دریافت محتوای ویجت، بر اساس زبان سیستم و محتوا
     * @param $location
     * @return string
     */
    public static function getWidget($location)
    {
        $model = Widget::findOne(['shortCode' => $location, 'language' => Yii::$app->Language->contentLanguageID()]);
        if (!empty($model)) {
            // < Get Params >
            {
                if (class_exists('YiiMan\YiiBasics\modules\parameters\models\Parameters')) {
                    $content = Parameters::filter($model->content);
                } else {
                    $content = $model->content;
                }
            }
            // </ Get Params >
            return $content;
        } else {
            return '';
        }
    }

    /**
     * دریافت عنوان ویجت، بر اساس زبان سیستم و محتوا
     * @param $location
     * @return string
     */
    public static function getWidgetTitle($location)
    {
        $model = Widget::findOne(['shortCode' => $location, 'language' => Yii::$app->Language->contentLanguageID()]);
        if (!empty($model)) {
            // < Get Params >
            {

                    $content = $model->title;

            }
            // </ Get Params >
            return $content;
        } else {
            return '';
        }
    }


}
