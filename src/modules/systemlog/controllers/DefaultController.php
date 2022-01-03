<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\systemlog\controllers;

use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\systemlog\models\Systemlog;
use YiiMan\YiiBasics\modules\systemlog\models\SearchSystemlog;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Systemlog model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchSystemlog
     */
    public $model;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Systemlog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $post = Yii::$app->request->post();
        $searchModel = new SearchSystemlog();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // < user array >
        {

            $admins = \YiiMan\YiiBasics\modules\useradmin\models\User::find()->select('id,concat("admin:",`email`) as name')->asArray()->all();
            if (empty($admins)) {
                $admins = [];
            } else {
                $admins = ArrayHelper::map($admins, 'id', 'name');
            }

            $users = \YiiMan\YiiBasics\modules\user\models\User::find()->select('id,concat("front:",`username`) as name')->asArray()->all();
            if (empty($users)) {
                $users = [];
            } else {
                $users = ArrayHelper::map($users, 'id', 'name');
            }
            if ($searchModel->app_name == 'app-backend') {
                $users = $admins;
            }
        }
        // </ user array >

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'users'        => $users
        ]);
    }

    public function actionClear()
    {
        $res = Yii::$app->db->createCommand('TRUNCATE TABLE module_systemlog;')->execute();
        return $this->redirect(['index']);
    }

    public function init()
    {
        parent::init();
        $this->modelClass = new Systemlog();
    }
}
