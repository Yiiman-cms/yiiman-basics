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
use yii\rbac\Item;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class RoleSearch extends ModuleRbacAuthItem
{

    public function rules()
    {
        return
            [
                [
                    [
                        'ruleName',
                        'name',
                        'module_fa',
                        'module_en',
                        'description'
                    ],
                    'string'
                ]
            ];
    }

    /**
     * Creates data provider instance with search query applied
     * @param  array  $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ModuleRbacAuthItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->where(['type' => self::TYPE_ROLE]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'like',
            'name',
            $this->name
        ]);
        $query->andFilterWhere([
            'like',
            'module_en',
            $this->module_en
        ]);
        $query->andFilterWhere([
            'like',
            'module_fa',
            $this->module_fa
        ]);
        $query->andFilterWhere([
            'like',
            'description',
            $this->description
        ]);
        $query->andFilterWhere([
            'like',
            'rule_name',
            $this->ruleName
        ]);


        return $dataProvider;
    }

}
