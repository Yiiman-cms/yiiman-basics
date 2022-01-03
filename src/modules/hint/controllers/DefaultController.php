<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\hint\controllers;

use Yii;
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\hint\models\SearchHint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Hint model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchHint
     */
    public $model;

    /**
     * Lists all Hint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new $this->model();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hint model.
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
     * Finds the Hint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return Hint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($this->model = Hint::findOne($id)) !== null) {
            return $this->model;
        }

        throw new NotFoundHttpException(Yii::t('hint', 'The requested page does not exist.'));
    }

    /**
     * Creates a new Hint model.
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
     * Updates an existing Hint model.
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
     * Deletes an existing Hint model.
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
        $this->model = new SearchHint();
    }

    protected function upload()
    {


    }
}
