<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\gallery\controllers;

use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\gallery\models\GalleryCategories;
use YiiMan\YiiBasics\modules\gallery\models\SearchGalleryCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for GalleryCategories model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchGalleryCategories
     */
    public $model;


    /**
     * Lists all GalleryCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGalleryCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryCategories model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!empty($_GET['lng'])) {
            $model = $this->findModel($id, $_GET['lng']);
        } else {
            $model = $this->findModel($id);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new GalleryCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryCategories;

        if ($model->load(Yii::$app->request->post())) {
            $language = Language::find()->where(['default' => 1])->one();
            $model->language = $language->id;
            if ($model->save()) {
                $model->saveImage('image');
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
     * Updates an existing GalleryCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!empty($_GET['lng'])) {
            $model = $this->findModel($id, $_GET['lng']);
        } else {
            $model = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->saveImage('image');
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
     * Deletes an existing GalleryCategories model.
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
        $this->modelClass = new GalleryCategories();
    }

    protected function upload()
    {


    }
}
