<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\ticket\controllers;

use YiiMan\YiiBasics\modules\ticket\models\TicketDepartments;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\ticket\models\TicketDepartmentUsers;
use YiiMan\YiiBasics\modules\ticket\models\SearchTicketDepartmentUsers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketDepartmentUsersController implements the CRUD actions for TicketDepartmentUsers model.
 */
class TicketDepartmentUsersController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchTicketDepartmentUsers
     */
    public $model;
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all TicketDepartmentUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $departments = TicketDepartments::find()->all();
        return $this->render('index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Displays a single TicketDepartmentUsers model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new TicketDepartmentUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TicketDepartmentUsers;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TicketDepartmentUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TicketDepartmentUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function init()
    {
        parent::init();
        $this->modelClass = new TicketDepartmentUsers();
    }

    protected function upload()
    {


    }
}
