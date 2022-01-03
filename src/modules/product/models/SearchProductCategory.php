<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\product\models\ProductCategory;

/**
 * SearchProductCategory represents the model behind the search form of `YiiMan\YiiBasics\modules\product\models\ProductCategory`.
 */
class SearchProductCategory extends ProductCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'parent'
                ],
                'integer'
            ],
            [
                ['title'],
                'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param  array  $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductCategory::find();

        if ($this->hasLanguage) {
            if (!empty($_GET['lng'])) {
                $query = $query->where(['language' => $_GET['lng']]);
            } else {
                $query = $query->where(['language_parent' => null]);
            }
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent' => $this->parent,
        ]);

        $query->andFilterWhere([
            'like',
            'title',
            $this->title
        ]);

        return $dataProvider;
    }
}
