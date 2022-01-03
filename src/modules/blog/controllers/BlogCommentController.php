<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog\controllers;

use Yii;
use YiiMan\YiiBasics\modules\blog\models\BlogComment;
use YiiMan\YiiBasics\modules\blog\models\SearchBlogComment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogCommentController implements the CRUD actions for BlogComment model.
 */
class BlogCommentController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchBlogComment
     */
    public $model;
    public $hasLanguage = false;

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
     * Lists all BlogComment models.
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
     * Displays a single BlogComment model.
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
     * Finds the BlogComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return BlogComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lang = null)
    {
        if (($this->model = BlogComment::findOne($id)) !== null) {
            return $this->model;
        }

        throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
    }

    /**
     * Creates a new BlogComment model.
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
     * Updates an existing BlogComment model.
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
     * Deletes an existing BlogComment model.
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

    public function actionVerify($id)
    {
        $model = BlogComment::findOne($id);
        $model->status = $model::STATUS_ACTIVE;
        $model->save();
        if ($model->save()) {

            return 'انجام شد';
        } else {
            $text = '';
            foreach ($model->getErrorSummary(true) as $error => $t) {
                $text .= $error.' : '.$t;
            }
            return $text;
        }
    }

    public function actionUnVerify($id)
    {
        $model = BlogComment::findOne($id);
        $model->status = $model::STATUS_DE_ACTIVE;
        if ($model->save()) {

            return 'انجام شد';
        } else {
            $text = '';
            foreach ($model->getErrorSummary(true) as $error) {
                $text .= $error;
            }
            return $text;
        }

    }

    public function init()
    {
        parent::init();
        $this->model = new SearchBlogComment();
    }

    protected function upload()
    {


    }
}
