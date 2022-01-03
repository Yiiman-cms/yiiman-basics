<?php

namespace YiiMan\YiiBasics\modules\transactions\models;

use YiiMan\YiiBasics\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "{{%module_transactions_user_credits}}".
 *
 * @property int $id
 * @property double $credit مبلغ کردیت(تومان)
 * @property int $uid کاربری که کردیت را دریافت میکند
 * @property string $created_at تاریخ ایجاد
 * @property int $created_by شناسه ی کاربری که کردیت را ایجاد کرده است
 * @property int $created_user_mode نوع کاربری که ایجاد کردیت کرده است
 * @property string $description توضیحات
 * @property int $factor فاکتور
 * @property int $status وضعیت پرداخت
 *
 * @property TransactionsFactor $factor0
 * @property User $u
 * @property User $createdBy
 * @property UserAdmin $createdBy0
 */
class TransactionsUserCredits extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    const USER_MODE_ADMIN = 1;
    const USER_MODE_USER = 2;
    const USER_MODE_SYSTEM = 3;

    const STATUS_IN_WALLET=0;// داخل کیف پول
    const STATUS_REQUESTED=1;// درخواست واریز ثبت شده است
    const STATUS_OUTED=2;// به حساب بانکی کاربر واریز شده است
    const STATUS_PREVENTED=3;// مسدود شده


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_transactions_user_credits}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [['credit', 'uid', 'created_at', 'created_by', 'created_user_mode', 'factor'], 'required'],
                [['credit','status'], 'number'],
                [['uid', 'created_by', 'created_user_mode', 'factor'], 'integer'],
                [['created_at'], 'safe'],
                [['description'], 'string', 'max' => 255],
                [['factor'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\transactions\models\TransactionsFactor::className(), 'targetAttribute' => ['factor' => 'id']],
                [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\user\models\User::className(), 'targetAttribute' => ['uid' => 'id']],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\user\models\User::className(), 'targetAttribute' => ['created_by' => 'id']],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => \YiiMan\YiiBasics\modules\user\models\UserAdmin::className(), 'targetAttribute' => ['created_by' => 'id']],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('transactions', 'ID'),
            'credit' => Yii::t('transactions', 'مبلغ کردیت(تومان)'),
            'uid' => Yii::t('transactions', 'کاربری که کردیت را دریافت میکند'),
            'created_at' => Yii::t('transactions', 'تاریخ ایجاد'),
            'created_by' => Yii::t('transactions', 'شناسه ی کاربری که کردیت را ایجاد کرده است'),
            'created_user_mode' => Yii::t('transactions', 'نوع کاربری که ایجاد کردیت کرده است'),
            'description' => Yii::t('transactions', 'توضیحات'),
            'factor' => Yii::t('transactions', 'فاکتور'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactor0()
    {
        return $this->hasOne(TransactionsFactor::className(), ['id' => 'factor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(UserAdmin::className(), ['id' => 'created_by']);
    }

    public static function addCredit(int $factor, int $uid, float $price, string $description)
    {
        $model = new self();
        $model->factor = $factor;
        $model->uid = $uid;
        $model->credit = $price;
        $model->description = $description;
        $model->created_at = date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->id;
        $user = User::findOne($uid);
        if (!empty($user)) {
            $user->chargeUser(-$price, $description);
            $user->correctCredit();
        }
        return !$model->save();
    }
}
