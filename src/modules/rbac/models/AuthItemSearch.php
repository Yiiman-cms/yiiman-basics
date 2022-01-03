<?php

namespace YiiMan\YiiBasics\modules\rbac\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\rbac\Item;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
abstract class AuthItemSearch extends AuthItem
{

    public $module;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return
            [
                [['name', 'description', 'module_en', 'module_fa','module'], 'safe'],
            ];
    }

    public static function find($name)
    {
        throw new \yii\base\Exception('Not support find() method in this object');
    }

    /**
     * Search authitem
     * @param array $params
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params)
    {
        $authManager = Yii::$app->authManager;
        if ($this->getType() == Item::TYPE_ROLE) {
            $items = $authManager->getRoles();
        } else {
            $items = $authManager->getPermissions();
        }

        if ($this->load($params) && $this->validate() && (trim($this->name) !== '' || trim($this->description) !== '' || trim($this->module) !== '')) {
            $search = strtolower(trim($this->name));
            $desc = strtolower(trim($this->description));
            $module = strtolower(trim($this->module));
            $items = array_filter($items, function ($item) use ($search, $desc,$module) {
                return (empty($search) || strpos(strtolower($item->name), $search) !== false) && (empty($desc) || strpos(strtolower($item->description), $desc) !== false)&& (empty($module) || strpos(strtolower($item->module_fa), $module) !== false);
            });
        }
        return new ArrayDataProvider([
            'allModels' => $items,
        ]);
    }
}
