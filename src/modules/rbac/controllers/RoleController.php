<?php

namespace YiiMan\YiiBasics\modules\rbac\controllers;

use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthAssignment;
use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem;
use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItemChild;
use YiiMan\YiiBasics\modules\rbac\models\Permission;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use YiiMan\YiiBasics\modules\rbac\models\Role;
use YiiMan\YiiBasics\modules\rbac\models\RoleSearch;

/**
 * RoleController is controller for manager role
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class RoleController extends \YiiMan\YiiBasics\lib\Controller
{

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
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
     * Displays a single Role model.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function actionView($name)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'title' => $name,
                'content' => $this->renderPartial(
                    'view',
                    [
                        'model' => $this->findModel($name),
                    ]
                ),
                'footer' => Html::button(
                        Yii::t('rbac', 'Close'),
                        ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]
                    ) .
                    Html::a(
                        Yii::t('rbac', 'Edit'),
                        ['update', 'name' => $name],
                        ['class' => 'btn btn-primary', 'role' => 'modal-remote']
                    )
            ];
        } else {
            return $this->render(
                'view',
                [
                    'model' => $this->findModel($name),
                ]
            );
        }
    }

    /**
     * Creates a new Role model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new ModuleRbacAuthItem();

        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['update', 'name' => $model->name]);
        }
        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );


    }

    /**
     * Updates an existing Role model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($name);

        ($model->load($request->post()) && $model->save());

        $model->load($request->post());

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );


    }

    /**
     * Delete an existing Role model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function actionDelete($name)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($name);
        if ($model->name == 'superadmin') {
            Yii::$app->session->addFlash('success', 'نقش سوپر ادمین قابل حذف نیست.');

            return $this->redirect(['index']);
        }

        // < assignments >
        {
            $assignment = ModuleRbacAuthAssignment::find()->where(['item_name' => $model->name])->all();
            foreach ($assignment as $a) {
                $a->delete();
            }
        }
        // </ assignments >

        // < delete permissions >
        {
            $permissions = ModuleRbacAuthItemChild::find()->where(['parent' => $model->name])->all();
            if (!empty($permissions)) {
                foreach ($permissions as $p) {
                    $p->delete();
                }
            }
        }
        // </ delete permissions >

        // < delete Role >
        {
            $model->delete();
        }
        // </ delete Role >

        Yii::$app->session->addFlash('success', 'نقش و همه ی زیر مجموعه های آن با موفقیت حذف شد');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $name
     *
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name, $lng = null)
    {
        if (($model = ModuleRbacAuthItem::findOne(['name' => $name, 'type' => ModuleRbacAuthItem::TYPE_ROLE])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('rbac', 'The requested page does not exist.'));
        }
    }

}
