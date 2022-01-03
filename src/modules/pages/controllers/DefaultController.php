<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\pages\controllers;

use Codeception\PHPUnit\Constraint\Page;
use Exception;
use YiiMan\YiiBasics\lib\MetaLib;
use YiiMan\YiiBasics\modules\metadata\models\Metadata;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\pages\models\SearchPages;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Pages model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchPages
     */
    public $model;


    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new $this->model();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    public function actionSetDefault($id)
    {
        $model = Pages::findOne($id);
        if (!empty($model)) {
            if ($model->setDefault()) {
                return \Yii::t('site', 'با موفقیت انجام شد');
            }
        }
        throw new BadRequestHttpException(\Yii::t('site', 'خطایی در انجام عملیات رخ داد'));
    }

    /**
     * Displays a single Pages model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        foreach (Pages::getAllTemplates() as $template => $item) {

            $model = new Pages();
            $model->title = 'برگه ی جدید';
            $model->template = $template;
            $model->status = 0;
            $model->created_at = date('Y-m-d H:i:s');
            $model->content = '<h1>'.\Yii::t('pages', 'به صفحه ی جدید خود سلام کنید').'</h1>';
            if ($model->save()) {
                return $this->redirect(['/pages/widget?id='.$model->id]);
            } else {
                echo '<pre>';
                var_dump($model->errors);
                die();
            }
        }


    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {

                return $this->redirect([
                    'index',
                    'id' => $model->id
                ]);
            }
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Pages::findOne($id);
        if (!empty($model)) {
            $name = $model->title;
            $model->delete();
            Yii::$app->session->addFlash('success', 'این صفحه ('.$name.') با موفقیت حذف شد');
        } else {
            Yii::$app->session->addFlash('success', 'صفحه از قبل حذف شده بود');
        }
        return $this->redirect(['index']);
    }

    public function init()
    {
        parent::init();
        $this->modelClass = Pages::className();
        $this->model = new SearchPages();
    }

    protected function upload()
    {


    }
}
