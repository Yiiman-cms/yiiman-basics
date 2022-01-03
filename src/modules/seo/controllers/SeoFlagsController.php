<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\seo\controllers;

use Yii;
use YiiMan\YiiBasics\modules\seo\models\SeoFlags;
use YiiMan\YiiBasics\modules\seo\models\SearchSeoFlags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeoFlagsController implements the CRUD actions for SeoFlags model.
 */
class SeoFlagsController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchSeoFlags
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
     * Lists all SeoFlags models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new $this->model();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SeoFlags model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the SeoFlags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return SeoFlags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang = null)
    {
        if (($this->model = SeoFlags::findOne($id)) !== null) {
            return $this->model;
        }

        throw new NotFoundHttpException(Yii::t('seo', 'The requested page does not exist.'));
    }

    /**
     * Creates a new SeoFlags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new $this->model();

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
     * Updates an existing SeoFlags model.
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
     * Deletes an existing SeoFlags model.
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
        $this->model = new SearchSeoFlags();
    }

    protected function upload()
    {


    }
}
