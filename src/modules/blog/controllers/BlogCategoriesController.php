<?php

namespace YiiMan\YiiBasics\modules\blog\controllers;

use Exception;
use YiiMan\YiiBasics\modules\blog\models\BlogCategory;
use YiiMan\YiiBasics\modules\blog\models\SearchBlogCategory;
use YiiMan\YiiBasics\modules\metadata\models\Metadata;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use YiiMan\YiiBasics\modules\blog\models\BlogArticles;
use YiiMan\YiiBasics\modules\blog\models\SearchBlogArticles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for BlogArticles model.
 */
class BlogCategoriesController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     *
     * @var $model SearchBlogArticles
     */
    public $enableCsrfValidation = false;


    /**
     * Lists all BlogArticles models.
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

    /**
     * Displays a single BlogArticles model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $model = new BlogArticles();
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {


                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            if (!empty($post['content'])) {
                $model->content = nl2br($post['content']);
            }
        }


        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing BlogArticles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();


        return $this->redirect(['index']);
    }


    public function init()
    {
        parent::init();
        $this->modelClass = BlogCategory::className();
        $this->model = new SearchBlogCategory();
    }
}
