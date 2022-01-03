<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\notification\controllers;

use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\notification\models\NotificationMessages;
use YiiMan\YiiBasics\modules\notification\models\SearchNotificationMessages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for NotificationMessages model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchNotificationMessages
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
     * Lists all NotificationMessages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchNotificationMessages();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotificationMessages model.
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
     * Creates a new NotificationMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotificationMessages;

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
     * Updates an existing NotificationMessages model.
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
     * Deletes an existing NotificationMessages model.
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

    public function actionLoadform()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['id'])) {
            $gateClass = \stdClass::class;
            eval('$gateClass = new YiiMan\YiiBasics\modules\transactions\Terminals\\'.$post['id'].';');
            /**
             * @var $gateClass PaymentTerminal
             */
            $forms = $gateClass->renderForm();
        }
    }

    public function actionLoadJs()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['id'])) {
            $gateClass = \stdClass::class;
            eval('$gateClass = new YiiMan\YiiBasics\modules\transactions\Terminals\\'.$post['id'].';');
            /**
             * @var $gateClass PaymentTerminal
             */
            $out = '<script>'.$gateClass->renderJS().'</script>';
            return $out;
        }
    }

    public function init()
    {
        parent::init();
        $this->modelClass = new NotificationMessages();
    }

    protected function upload()
    {


    }
}
