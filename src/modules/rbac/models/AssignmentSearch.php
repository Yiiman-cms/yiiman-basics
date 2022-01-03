<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\rbac\Module;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class AssignmentSearch extends ModuleRbacAuthAssignment
{

    /**
     * @var Module $rbacModule
     */
    protected $rbacModule;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return
            [
                [
                    [
                        'item_name',
                        'user_id',
                        'created_at'
                    ],
                    'safe'
                ],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return
            [
                'item_name' => Yii::t('rbac', 'نقش'),
                'user_id' => Yii::t('rbac', 'کاربر'),
                'created_at' => Yii::t('rbac', 'تاریخ ثبت'),
            ];
    }

    /**
     * Create data provider for Assignment model.
     */
    public function search()
    {
        $query = self::find();
        $query->groupBy(['item_name']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $params = Yii::$app->request->getQueryParams();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'like',
            'item_name',
            $this->item_name
        ]);
        $query->andFilterWhere([
            'like',
            'user_id',
            $this->user_id
        ]);

        return $dataProvider;
    }

}
