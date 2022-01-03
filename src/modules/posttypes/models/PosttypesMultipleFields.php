<?php

namespace YiiMan\YiiBasics\modules\posttypes\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "{{%module_posttypes_fields}}".
 *
 * @property string $key
 * @property string $value
 *
 * @property int $posttype_id
 * @property string $posttype
 * @property string $posttype_field_name
 *
 * @property string $multiple_field_name
 * @property int $multiple_field_id
 *
 * @property PosttypesMultiple $posttype_multiple0
 *
 */
class PosttypesMultipleFields extends \YiiMan\YiiBasics\lib\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_posttypes_multiples_fields}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value', 'posttype_id', 'posttype', 'posttype_field_name', 'multiple_field_name', 'multiple_field_id'], 'required'],

            [['posttype_id', 'multiple_field_id'], 'integer'],
            [['key', 'value', 'posttype', 'posttype_field_name', 'multiple_field_name'], 'safe'],

            [['multiple_field_id'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\posttypes\models\PosttypesMultiple::className(), 'targetAttribute' => ['multiple_field_id' => 'id']],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttype_multiple0()
    {
        return $this->hasOne(PosttypesMultiple::className(), ['id' => 'multiple_field_id']);
    }


}
