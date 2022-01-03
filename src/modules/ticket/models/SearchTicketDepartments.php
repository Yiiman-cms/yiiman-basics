<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\ticket\models\TicketDepartments;

/**
 * SearchTicketDepartments represents the model behind the search form of `YiiMan\YiiBasics\modules\ticket\models\TicketDepartments`.
 */
class SearchTicketDepartments extends TicketDepartments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'language', 'language_parent'], 'integer'],
            [['title'], 'safe'],
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
        $query = TicketDepartments::find();

        if ($this->hasLanguage){
            if (!empty( $_GET['lng'])){
                $query=$query->where(['language'=> $_GET['lng']]);
            }else{
                $query=$query->where(['language_parent'=>null]);
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
            'status' => $this->status,
            'language' => $this->language,
            'language_parent' => $this->language_parent,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
