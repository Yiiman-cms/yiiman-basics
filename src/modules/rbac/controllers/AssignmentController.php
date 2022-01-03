<?php

namespace YiiMan\YiiBasics\modules\rbac\controllers;

use YiiMan\YiiBasics\modules\rbac\models\AuthItem;
use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthAssignment;
use YiiMan\YiiBasics\modules\rbac\models\ModuleRbacAuthItem;
use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use YiiMan\YiiBasics\modules\rbac\Module;
use YiiMan\YiiBasics\modules\rbac\models\AssignmentSearch;
use YiiMan\YiiBasics\modules\rbac\models\AssignmentForm;

/**
 * AssignmentController is controller for manager user assignment
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since  1.0.0
 */
class AssignmentController extends \YiiMan\YiiBasics\lib\Controller
{


    /**
     * Show list of user for assignment
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignmentSearch;
        $dataProvider = $searchModel->search();

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]
        );
    }


    public function actionCreate()
    {
        $model = new ModuleRbacAuthAssignment();
        $post = Yii::$app->request->post();
        $roleModels = ModuleRbacAuthItem::find()->where(['type' => ModuleRbacAuthItem::TYPE_ROLE])->asArray()->all();
        if (!empty($roleModels)) {
            $roles = ArrayHelper::map($roleModels, 'name', 'name');
        } else {
            $roles = [];
        }
        $users = ArrayHelper::map(User::find()->asArray()->all(), 'id', 'email');

        if (!empty($post)) {
            $oldSaved = ModuleRbacAuthAssignment::find()
                ->where(
                    [
                        'item_name' => $post['ModuleRbacAuthAssignment']['item_name'],
                    ]
                )
                ->all();

            if (!empty($oldSaved)) {
                foreach ($oldSaved as $s) {
                    $s->delete();
                }
            }

            foreach ($post['ModuleRbacAuthAssignment']['users'] as $uid) {

                $oldSaved = ModuleRbacAuthAssignment::findOne(
                    [
                        'item_name' => $post['ModuleRbacAuthAssignment']['item_name'],
                        'user_id' => $uid,
                    ]
                );
                if (empty($oldSaved)) {
                    $newSaved = new ModuleRbacAuthAssignment;
                    $newSaved->item_name = $post['ModuleRbacAuthAssignment']['item_name'];
                    $newSaved->user_id = (string)$uid;
                    $newSaved->created_at = date('Y-m-d H:i:s');
                    $newSaved->save();
                }
            }
            Yii::$app->session->addFlash('success','نقش '.$post['ModuleRbacAuthAssignment']['item_name'].' با موفقیت برای کاربران انتخابی ثبت شد');
            return  $this->redirect(['index']);
        }


        return $this->render('assignment', ['model' => $model, 'roles' => $roles, 'users' => $users]);
    }

    /**
     * Assignment roles to user
     *
     * @param mixed $id The user id
     *
     * @return mixed
     */
    public function actionAssignment($id)
    {
        $model = new ModuleRbacAuthAssignment();
        $model->item_name=$id;
        $model->loadUsers();

        $post = Yii::$app->request->post();
        $roleModels = ModuleRbacAuthItem::find()->where(['type' => ModuleRbacAuthItem::TYPE_ROLE])->asArray()->all();
        if (!empty($roleModels)) {
            $roles = ArrayHelper::map($roleModels, 'name', 'name');
        } else {
            $roles = [];
        }
        $users = ArrayHelper::map(User::find()->asArray()->all(), 'id', 'email');

        if (!empty($post)) {
            $oldSaved = ModuleRbacAuthAssignment::find()
                ->where(
                    [
                        'item_name' => $post['ModuleRbacAuthAssignment']['item_name'],
                    ]
                )
                ->all();

            if (!empty($oldSaved)) {
                foreach ($oldSaved as $s) {
                    $s->delete();
                }
            }
            if (!empty($post['ModuleRbacAuthAssignment']['users'])){

                foreach ($post['ModuleRbacAuthAssignment']['users'] as $uid) {

                    $oldSaved = ModuleRbacAuthAssignment::findOne(
                        [
                            'item_name' => $post['ModuleRbacAuthAssignment']['item_name'],
                            'user_id' => $uid,
                        ]
                    );
                    if (empty($oldSaved)) {
                        $newSaved = new ModuleRbacAuthAssignment;
                        $newSaved->item_name = $post['ModuleRbacAuthAssignment']['item_name'];
                        $newSaved->user_id = (string)$uid;
                        $newSaved->created_at = date('Y-m-d H:i:s');
                        $newSaved->save();
                    }
                }
            }
            Yii::$app->session->addFlash('success','نقش '.$post['ModuleRbacAuthAssignment']['item_name'].' با موفقیت برای کاربران انتخابی ثبت شد');
            return  $this->redirect(['index']);
        }


        return $this->render('assignment', ['model' => $model, 'roles' => $roles, 'users' => $users]);
    }

}
