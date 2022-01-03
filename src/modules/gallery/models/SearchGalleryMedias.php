<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\gallery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;

/**
 * SearchGalleryMedias represents the model behind the search form of `YiiMan\YiiBasics\modules\gallery\models\GalleryMedias`.
 */
class SearchGalleryMedias extends GalleryMedias
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
                    'table_id',
                    'category',
                    'language',
                    'language_parent'
                ],
                'integer'
            ],
            [
                [
                    'type',
                    'table',
                    'description',
                    'file_name'
                ],
                'safe'
            ],
            [
                ['file_size'],
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
        $query = GalleryMedias::find();
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
            'id'              => $this->id,
            'table_id'        => $this->table_id,
            'file_size'       => $this->file_size,
            'category'        => $this->category,
            'language'        => $this->language,
            'language_parent' => $this->language_parent,
        ]);

        $query->andFilterWhere([
            'like',
            'type',
            $this->type
        ])
            ->andFilterWhere([
                'like',
                'table',
                $this->table
            ])
            ->andFilterWhere([
                'like',
                'description',
                $this->description
            ])
            ->andFilterWhere([
                'like',
                'file_name',
                $this->file_name
            ]);

        return $dataProvider;
    }
}
