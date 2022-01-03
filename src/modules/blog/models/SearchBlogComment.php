<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\blog\models\BlogComment;

/**
 * SearchBlogComment represents the model behind the search form of `YiiMan\YiiBasics\modules\blog\models\BlogComment`.
 */
class SearchBlogComment extends BlogComment
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
                    'article',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'message',
                    'name',
                    'email',
                    'website',
                    'created_at'
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
        $query = BlogComment::find();

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
            'article'    => $this->article,
            'created_at' => $this->created_at,
            'status'     => $this->status,
        ]);

        $query->andFilterWhere([
            'like',
            'message',
            $this->message
        ])
            ->andFilterWhere([
                'like',
                'name',
                $this->name
            ])
            ->andFilterWhere([
                'like',
                'email',
                $this->email
            ])
            ->andFilterWhere([
                'like',
                'website',
                $this->website
            ]);

        return $dataProvider;
    }
}
