<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\useradmin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * SearchUser represents the model behind the search form of `YiiMan\YiiBasics\modules\useradmin\models\User`.
 */
class SearchUser extends User
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

                    'auth_key',
                    'password_hash',
                    'password_reset_token',

                    'updated_at',

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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id'         => $this->id,
                'updated_at' => $this->updated_at,
                'status'     => $this->status,
            ]
        );

        $query->andFilterWhere([
            'like',
            'email',
            $this->email
        ])
            ->andFilterWhere([
                'like',
                'auth_key',
                $this->auth_key
            ])
            ->andFilterWhere([
                'like',
                'password_hash',
                $this->password_hash
            ])
            ->andFilterWhere([
                'like',
                'password_reset_token',
                $this->password_reset_token
            ]);

        return $dataProvider;
    }

    public function searchJobStatus($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id'         => $this->id,
                'updated_at' => $this->updated_at,
                'status'     => $this->status,
            ]
        );


        return $dataProvider;
    }
}
