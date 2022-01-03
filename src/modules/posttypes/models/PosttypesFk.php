<?php

namespace YiiMan\YiiBasics\modules\posttypes\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "{{%module_posttypes_fields}}".
 *
 * @property int $posttype_from
 * @property int $posttype_to
 * @property string $posttype_type_from
 * @property string $posttype_type_to
 *
 * @property Posttypes $posttypes_from0
 * @property Posttypes $posttypes_to0
 *
 *
 * @property Posttypes $posttype_from0
 * @property Posttypes $posttype_to0
 *
 *
 */
class PosttypesFk extends \YiiMan\YiiBasics\lib\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_posttypes_fk}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posttype_from', 'posttype_to', 'posttype_type_from', 'posttype_type_to'], 'required'],

            [['posttype_to', 'posttype_from'], 'integer'],
            [['posttype_type_from', 'posttype_type_to',], 'string', 'max' => 255],
            [['posttype_from'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::className(), 'targetAttribute' => ['posttype_from' => 'id']],
            [['posttype_to'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\posttypes\models\Posttypes::className(), 'targetAttribute' => ['posttype_to' => 'id']],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttype_from0()
    {
        return $this->hasOne(Posttypes::className(), ['id' => 'posttype_from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttype_to0()
    {
        return $this->hasOne(Posttypes::className(), ['id' => 'posttype_to']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttypes_from0()
    {
        return $this->hasMany(Posttypes::className(), ['id' => 'posttype_from']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosttypes_to0()
    {
        return $this->hasMany(Posttypes::className(), ['id' => 'posttype_to']);
    }


}
