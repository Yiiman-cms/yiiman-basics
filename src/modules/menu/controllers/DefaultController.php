<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menu\controllers;

use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\products\models\Products;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use Yii;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\menu\models\SearchMenu;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Menu model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchMenu
     */
    public $model;


    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SearchMenu();
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
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect([
                    'index',
                    'id' => $model->id
                ]);
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
     * Updates an existing Menu model.
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
     * Deletes an existing Menu model.
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

    public function actionRelatedData()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($post)) {
            $type = Menu::getType($post['type']);
            return ArrayHelper::map($type['model']::find()->all(), $type['modelMap'][0], $type['modelMap'][1]);
        }
    }

    public function init()
    {
        parent::init();
        $this->model = new Menu();
        $this->modelClass = $this->model::className();
    }

    protected function upload()
    {


    }
}
