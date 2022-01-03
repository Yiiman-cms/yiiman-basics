<?php

namespace YiiMan\YiiBasics\modules\posttypes\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "{{%module_posttypes_fields}}".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $type
 * @property int $posttype_id
 * @property int $index
 *
 * @property string $posttype
 * @property Posttypes $posttype0
 * @property string $fieldName
 *
 *
 *
 */
class PosttypesMultiple extends \YiiMan\YiiBasics\lib\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_posttypes_multiples}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'posttype_id', 'posttype', 'fieldName', 'fieldName'], 'required'],

            [['posttype_id', 'index'], 'integer'],
            [['value', 'key', 'posttype', 'fieldName', 'type'], 'safe'],

            [['posttype_id'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::className(), 'targetAttribute' => ['posttype_id' => 'id']],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttype0()
    {
        return $this->hasOne(Posttypes::className(), ['id' => 'posttype_id']);
    }


}
