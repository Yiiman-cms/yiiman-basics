<?php

namespace YiiMan\YiiBasics\modules\menumodern\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use YiiMan\YiiBasics\modules\menumodern\models\Menu;

class MenuSearch extends Menu{

    public function rules()
    {
        return [
            [['name', 'code'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function searchLevel1($params){

        $query = Menu::find();
        $query->where(['menuType'=>'child']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
    
     public function searchLevel2($params){

        $query = Menu::find();
        $query->where(['menuType'=>'child2']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
    
    public function searchLevel3($params){

        $query = Menu::find();
        $query->where(['menuType'=>['childParent2','childParent3']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
    
    
}
