<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\seo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\seo\models\SeoFlagContents;

/**
 * SearchSeoFlagContents represents the model behind the search form of `YiiMan\YiiBasics\modules\seo\models\SeoFlagContents`.
 */
class SearchSeoFlagContents extends SeoFlagContents
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
                    'title',
                    'full_content',
                    'short_content',
                    'slug'
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
        $query = SeoFlagContents::find();

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

        $query->andFilterWhere([
            'like',
            'title',
            $this->title
        ])
            ->andFilterWhere([
                'like',
                'full_content',
                $this->full_content
            ])
            ->andFilterWhere([
                'like',
                'short_content',
                $this->short_content
            ])
            ->andFilterWhere([
                'like',
                'slug',
                $this->slug
            ]);

        return $dataProvider;
    }
}
