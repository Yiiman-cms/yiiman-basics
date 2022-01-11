<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\parameters\controllers;

use Guzzle\Service\Description\Parameter;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\parameters\models\Parameters;
use YiiMan\YiiBasics\modules\parameters\models\SearchParameters;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Parameters model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchParameters
     */
    public $model;


    /**
     * Lists all Parameters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = Parameters::find();
        if (!empty($_GET['lng'])) {
            $dataProvider = $dataProvider->where(['language' => $_GET['lng']]);
        } else {
            $dataProvider = $dataProvider->where(['language_parent' => null]);
        }

        $post = Yii::$app->request->post();
        if (!empty($post)) {
            if (!empty($post['keys'])) {
                foreach ($post['keys'] as $key => $item) {
                    $key = str_replace([
                        ' ',
                        '-'
                    ], [
                        '',
                        '_'
                    ], $key);
                    $model = Parameters::findOne(['key' => $key]);
                    if (!empty($model)) {
                        $model->val = nl2br($item['val']);
                        if (!empty($item['description'])) {
                            $model->description = nl2br($item['description']);
                        }
                        $model->save();
                    }
                }
            }

            if (!empty($post['new'])) {
                foreach ($post['new'] as $item) {
                    if (!empty($item['key'])) {
                        $key = str_replace([
                            ' ',
                            '-'
                        ], [
                            '',
                            '_'
                        ], $item['key']);
                        $model = Parameters::findOne(['key' => $key]);
                        if (empty($model)) {
                            $model = new Parameters();
                            $model->key = str_replace([
                                '}}',
                                '{{'
                            ], '', $key);
                            $model->val = nl2br($item['val']);
                            $model->save();
                        }
                    }
                }
            }
        } else {
            $this->actionInsert();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider->all(),
        ]);
    }

    public function actionInsert()
    {
        foreach (Parameters::getAllParameters(false) as $p) {

            $model = Parameters::findOne(['key' => $p['key']]);
            if (empty($model)) {
                if (empty($p['private'])) {
                    $p['private'] = 0;
                }
                if (empty($p['protected'])) {
                    $p['protected'] = 0;
                }
                if (empty($p['val'])) {
                    $p['val'] = '0';
                }
                if (empty($p['editor'])) {
                    $p['editor'] = 0;
                }

                if (empty($p['description'])) {
                    $p['description'] = ' ';
                }

                $model = new Parameters();
                $model->key = $p['key'];
                $model->description = nl2br($p['description']);
                $model->private = $p['private'];
                $model->protected = $p['protected'];
                $model->val = $p['val'];
                $model->editor = $p['editor'];
                $model->save();
            }
        }
    }

    /**
     * Displays a single Parameters model.
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
     * Creates a new Parameters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parameters;

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
     * Updates an existing Parameters model.
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
     * Deletes an existing Parameters model.
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

    public function actionRemove()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($post['id'])) {
            $id = str_replace('db-', '', $post['id']);
            $model = Parameters::findOne($id);
            if (!empty($model)) {
                if ($model->delete()) {
                    return [
                        'status' => 'removed',
                        'data'   => $id
                    ];
                } else {
                    return [
                        'status'   => 'errors',
                        'messages' => $model->errors
                    ];
                }
            } else {
                return [
                    'status'  => 'error',
                    'message' => \Yii::t('parameters', 'مورد در بانک داده یافت نشد')
                ];
            }
        }
    }

    public function actionFilter()
    {
        $post = Yii::$app->request->post();
        if (!empty($post['text'])) {
            return Parameters::filter($post['text']);
        }
    }

    public function actionAjaxAdd()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($post['key'])) {

            $model = Parameters::findOne(['key' => $post['key']]);
            if (empty($model)) {

                $model = new Parameters();
                $model->key = $post['key'];
                $model->val = $post['val'];
                $model->description = $post['description'];
                $model->protected = 0;
                $model->private = 0;
                if ($model->save()) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            } else {
                $model->val = $post['val'];
                $model->description = $post['description'];
                if ($model->save()) {
                    return ['status' => 'ok'];
                } else {
                    return ['status' => 'error'];
                }
            }

        }
    }

    public function init()
    {
        parent::init();
        $this->modelClass = new Parameters();
    }

    protected function upload()
    {


    }
}
