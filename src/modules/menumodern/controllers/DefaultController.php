<?php

namespace YiiMan\YiiBasics\modules\menumodern\controllers;

use Yii;
use YiiMan\YiiBasics\modules\menumodern\models\Menu;
use YiiMan\YiiBasics\modules\menumodern\models\MenuSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use function realpath;
use function rmdir;
use function unlink;

class DefaultController extends Controller
{

//		public function behaviors() {
//			return [
//				'access' => [
//					'class' => AccessControl::className() ,
//					'rules' => [
//						[ 'allow' => true , 'actions' => [ 'index' ] , 'roles' => [ 'indexMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'create' ] , 'roles' => [ 'createMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'update' ] , 'roles' => [ 'updateMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'publish' ] , 'roles' => [ 'updateMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'delete' ] , 'roles' => [ 'deleteMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'view' ] , 'roles' => [ 'viewMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'indexx' ] , 'roles' => [ 'viewMenu' ] ] ,
//						[ 'allow' => true , 'actions' => [ 'parents' ] , 'roles' => [ 'updateMenu' ] ] ,
//					] ,
//				] ,
//				'verbs'  => [
//					'class'   => VerbFilter::className() ,
//					'actions' => [
//						'delete' => [ 'post' ] ,
//					] ,
//				] ,
//			];
//		}

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Menu();
        if (!empty($_GET['id'])) {
            $m = Menu::findOne($_GET['id']);

            switch ($m->menuType) {
                case 'right':
                    $model->parent = $m->parent_id;
                    $model->right = $m->id;
                    $model->menuType = 'child';
                    break;
                case 'child':
                    $model->menuType = 'child2';
                    $parent = Menu::findOne($m->parent_id);
                    $model->parent = $parent->parent_id;
                    $model->right = $model->parent_id;
                    break;
                case 'child2':
                    $model->menuType = 'child2';
                    $right = Menu::findOne($m->parent_id);
                    $model->right = $right->parent_id;
                    $parent = Menu::findOne($right->parent_id);
                    $model->parent = $parent->parent_id;
                    $model->child = $model->parent_id;
                    break;
            }


        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            switch ($model->menuType) {
                case 'parent':
                    $model->parent_id = 0;
                    break;
                case 'right':
                    $model->parent_id = $model->parent;
                    break;
                case 'child':
                    $model->parent_id = $model->right;
                    break;
                case 'child2':
                    $model->parent_id = $model->child;
                    break;
            }
            $model->position = (int)$model->pos;
            $model->save();

            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['status' => 'ok', 'tid' => $model->id, 'label' => $model->name, 'icon' => $model->icon];
        } else {
            if (!empty($_GET['type'])) {
                if ($_GET['type'] == 'tabmenu') {
                    $model->menuType = 'right';
                    $model->parent = $_GET['tid'];
                }
            }

            $model->pos = $model->position;
            return $this->renderAjax(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        switch ($model->menuType) {
            case 'right':
                $model->parent = $model->parent_id;
                break;
            case 'child':
                $parent = Menu::findOne($model->parent_id);
                $model->parent = $parent->parent_id;
                $model->right = $model->parent_id;
                break;
            case 'child2':
                $child = Menu::findOne($model->parent_id);
                $model->child = $child->id;
                $model->right = $child->parent_id;
                $parent = Menu::findOne($child->parent_id);
                $model->parent = $parent->parent_id;
                break;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->position = 10;

            switch ($model->menuType) {
                case 'parent':
                    $model->parent_id = 0;
                    break;
                case 'right':
                    $model->parent_id = $model->parent;
                    break;
                case 'child':
                    $model->parent_id = $model->right;
                    break;
                case 'child2':
                    $model->parent_id = $model->child;
                    break;
            }
            $model->position = (int)$model->pos;
            $model->save();


            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['status' => 'ok', 'tid' => $model->id, 'label' => $model->name, 'icon' => $model->icon];
        } else {

            $model->pos = $model->position;
            return $this->renderAjax(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->findModel($id)->delete();

        return ['status' => 'ok', 'tid' => $id];
    }

    /**
     * @param $id
     *
     * @return \YiiMan\YiiBasics\modules\menumodern\models\Menu|null
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndexx()
    {


        return $this->renderAjax(
            'indexAjax'
        );
    }


    public function actionRelatedData()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($post)) {
            $type = Menu::getType($post['type']);
            return
                [
                    'label' => $type['label'],
                    'data' => ArrayHelper::map($type['model']::find()->all(), $type['modelMap'][0], $type['modelMap'][1])
                ];

        }
    }


    public function actionParents()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (!empty($post['type'])) {

            return ArrayHelper::map(
                Menu::find()->where(['parent_id' => $post['parent']])->all(),
                'id',
                'name'
            );


        }
    }

    public function actionPublish()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        @unlink(realpath(__DIR__ . '/../models/menu.text'));
        return ['status' => 'ok'];
    }
}
