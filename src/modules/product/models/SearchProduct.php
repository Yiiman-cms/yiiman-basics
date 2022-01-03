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
use YiiMan\YiiBasics\modules\product\models\Product;

/**
 * SearchProduct represents the model behind the search form of `YiiMan\YiiBasics\modules\product\models\Product`.
 */
class SearchProduct extends Product
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
                    'status',
                    'hit',
                    'sold'
                ],
                'integer'
            ],
            [
                [
                    'hash',
                    'title',
                    'description',
                    'code',
                    'unit',
                    'created_at',
                    'updated_at',
                    'json_data'
                ],
                'safe'
            ],
            [
                [
                    'weight',
                    'discount'
                ],
                'number'
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
        $query = Product::find();

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
            'id'         => $this->id,
            'status'     => $this->status,
            'weight'     => $this->weight,
            'discount'   => $this->discount,
            'hit'        => $this->hit,
            'sold'       => $this->sold,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere([
            'like',
            'hash',
            $this->hash
        ])
            ->andFilterWhere([
                'like',
                'title',
                $this->title
            ])
            ->andFilterWhere([
                'like',
                'description',
                $this->description
            ])
            ->andFilterWhere([
                'like',
                'code',
                $this->code
            ])
            ->andFilterWhere([
                'like',
                'unit',
                $this->unit
            ])
            ->andFilterWhere([
                'like',
                'json_data',
                $this->json_data
            ]);

        return $dataProvider;
    }
}
