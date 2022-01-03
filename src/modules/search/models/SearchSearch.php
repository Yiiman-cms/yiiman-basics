<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\search\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\search\models\Search;

/**
 * SearchSearch represents the model behind the search form of `YiiMan\YiiBasics\modules\search\models\Search`.
 */
class SearchSearch extends Search
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
                    'resultCount'
                ],
                'integer'
            ],
            [
                [
                    'query',
                    'created_at',
                    'ip',
                    'result_types'
                ],
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
        $query = Search::find();

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
            'resultCount' => $this->resultCount,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere([
            'like',
            'query',
            $this->query
        ])
            ->andFilterWhere([
                'like',
                'ip',
                $this->ip
            ])
            ->andFilterWhere([
                'like',
                'result_types',
                $this->result_types
            ]);

        return $dataProvider;
    }
}
