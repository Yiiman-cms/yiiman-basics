<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\blog\controllers;

use Exception;
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
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchBlogArticles
     */
    public $enableCsrfValidation = false;
    public $model;
    public $slug;

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
     * @param  integer  $id
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
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                $model->saveSeoDetails();


                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        } else {
            if (!empty($post['content'])) {
                $model->content = nl2br($post['content']);
            }
        }
        if (!empty($post['BlogArticles']['seo_description'])) {
            $model->seo_description = $post['BlogArticles']['seo_description'];
        }
        if (!empty($post['BlogArticles']['tags'])) {
            $model->tags = $post['BlogArticles']['tags'];
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
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->loadSeoDetails();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->saveSeoDetails();
                return $this->redirect([
                    'view',
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
     * Deletes an existing BlogArticles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tags = Yii::$app->MetaLib->get('ARTICLE_SEO_TAG', $model->id);
        if (!empty($tags)) {
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    $count = Metadata::find()->where([
                        'module_id' => $model->id,
                        'meta_key'  => 'ARTICLE_SEO_TAG',
                        'content'   => $tag->content
                    ])->count();
                    if ($count == 1) {
                        Metadata::find()->where([
                            'module_id' => $model->id,
                            'meta_key'  => 'ARTICLE_SEO_TAG',
                            'content'   => $tag->content
                        ])->one()->delete();
                    }
                }
            } else {
                $count = Metadata::find()->where([
                    'module_id' => $model->id,
                    'meta_key'  => 'ARTICLE_SEO_TAG',
                    'content'   => $tags->content
                ])->count();
                if ($count == 1) {
                    Metadata::find()->where([
                        'module_id' => $model->id,
                        'meta_key'  => 'ARTICLE_SEO_TAG',
                        'content'   => $tags->content
                    ])->one()->delete();
                }
            }

        }
        $model->delete();

        return $this->redirect(['index']);
    }


    public function init()
    {
        parent::init();
        $this->modelClass = BlogArticles::className();
        $this->model = new SearchBlogArticles();
    }
}
