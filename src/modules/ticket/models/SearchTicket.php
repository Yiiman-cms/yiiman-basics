<?php

namespace YiiMan\YiiBasics\modules\ticket\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\ticket\models\Ticket;
use yii\helpers\ArrayHelper;

/**
 * SearchTicket represents the model behind the search form of `YiiMan\YiiBasics\modules\ticket\models\Ticket`.
 */
class SearchTicket extends Ticket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return
            [
                [['id', 'status', 'department', 'language', 'language_parent'], 'integer'],
                [['subject', 'created_at', 'created_by', 'updated_at','serial', 'updated_by', 'deleted_at', 'deleted_by', 'closed_at'], 'safe'],
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
        $query = Ticket::find();

        // < select User department Tickets >
        {
            $userDepartments = SearchTicketDepartmentUsers::find()
                ->select('department')
                ->where(['uid' => Yii::$app->user->id])
                ->asArray()
                ->all();
            if (!empty($userDepartments)) {
                $userDepartments = ArrayHelper::getColumn($userDepartments, 'department');
                $query->where(['department' => $userDepartments]);
            }
        }

        // </ select User department Tickets >

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'department' => $this->department,
            'deleted_at' => $this->deleted_at,
            'closed_at' => $this->closed_at,
            'language' => $this->language,
            'language_parent' => $this->language_parent,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }

    public function searchFront($params)
    {
        $query = Ticket::find();

        // < select Logged In User >
        {
            $query->where(['uid' => Yii::$app->user->id]);
        }

        // </ select Logged In User >


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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'department' => $this->department,
            'deleted_at' => $this->deleted_at,
            'closed_at' => $this->closed_at,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }


}
