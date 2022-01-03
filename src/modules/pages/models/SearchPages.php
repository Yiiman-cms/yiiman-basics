<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\pages\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\pages\models\Pages;

/**
 * SearchPages represents the model behind the search form of `YiiMan\YiiBasics\modules\pages\models\Pages`.
 */
class SearchPages extends Pages
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
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'content',
                    'seo_description',
                    'tags',
                    'title'
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
        $query = Pages::find();
        if (!empty($_GET['lng'])) {
            $query = $query->where(['language' => $_GET['lng']]);
        } else {
            $query = $query->where(['language_parent' => null]);
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
            'status' => $this->status,
        ]);

        $query
            ->andFilterWhere([
                'like',
                'content',
                $this->content
            ])
            ->andFilterWhere([
                'like',
                'seo_description',
                $this->seo_description
            ])
            ->andFilterWhere([
                'like',
                'tags',
                $this->tags
            ])
            ->andFilterWhere([
                'like',
                'title',
                $this->title
            ]);

        return $dataProvider;
    }
}
