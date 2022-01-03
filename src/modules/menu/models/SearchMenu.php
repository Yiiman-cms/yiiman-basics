<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\menu\models\Menu;

/**
 * SearchMenu represents the model behind the search form of `YiiMan\YiiBasics\modules\menu\models\Menu`.
 */
class SearchMenu extends Menu
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
                    'location',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'url',
                    'slug',
                    'icon',
                    'image'
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
        $query = Menu::find();

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
            'location' => $this->location,
            'status' => $this->status,

        ]);

        $query->andFilterWhere([
            'like',
            'title',
            $this->title
        ])
            ->andFilterWhere([
                'like',
                'url',
                $this->url
            ])
            ->andFilterWhere([
                'like',
                'slug',
                $this->slug
            ])
            ->andFilterWhere([
                'like',
                'icon',
                $this->icon
            ]);
        return $dataProvider;
    }
}
