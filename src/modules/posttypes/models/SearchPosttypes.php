<?php

namespace YiiMan\YiiBasics\modules\posttypes\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;

/**
 * SearchPosttypes represents the model behind the search form of `YiiMan\YiiBasics\modules\posttypes\models\Posttypes`.
 */
class SearchPosttypes extends Posttypes
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language', 'language_parent', 'status'], 'integer'],
            [['title', 'postType', 'created_at', 'updated_at', 'created_by', 'content'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Posttypes::find();



        if ($this->hasLanguage){
            if (!empty( $_GET['lng'])){
                $query=$query->where(['language'=> $_GET['lng']]);
            }else{
                $query=$query->where(['language_parent'=>null]);
            }
        }
        // add conditions that should always apply here


        if (!empty($_GET['posttype'])){
            $query->andWhere(['postType'=> $_GET['posttype']]);
        }

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
            'language' => $this->language,
            'language_parent' => $this->language_parent,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'postType', $this->postType])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
