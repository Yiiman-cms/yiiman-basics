<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\ticket\controllers;

use YiiMan\YiiBasics\modules\ticket\models\TicketMessages;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\ticket\models\Ticket;
use YiiMan\YiiBasics\modules\ticket\models\SearchTicket;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Ticket model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     * @var $model SearchTicket
     */
    public $model;

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTicket();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
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
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket;
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->updated_at = date('Y-m-d H:i:s');
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->nickName;
            $model->created_by = Yii::$app->user->identity->nickName;
            $model->status = $model::STATUS_ANSWERED;
            if ($model->save()) {
                $message = new TicketMessages();
                $message->ticket = $model->id;
                $message->message = nl2br($post['message']);
                $message->created_by = $model->updated_by;
                $message->created_at = $model->updated_at;
                $message->uid_admin = \Yii::$app->user->id;


                $message->save();

                // < save file >
                {
                    $uploadDir = \Yii::$app->Options->UploadDir.'/tickets/'.$model->id.'/'.$message->id.'/';
                    if (!empty($_FILES['file']['name'])) {
                        @mkdir($uploadDir, 0777, true);
                        move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir.$_FILES['file']['name']);
                        $message->file = $_FILES['file']['name'];
                        $message->save();
                    }

                }
                // </ save file >

                \Yii::$app->session->addFlash('success', 'تیک شما با موفقیت برای کاربر شد');
                return $this->redirect([
                    'update',
                    'id' => $model->id
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        /**
         * @var $model Ticket
         */
        $model = Ticket::findOne($id);

        $post = \Yii::$app->request->post();

        if (!empty($post)) {


            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->nickName;
            $model->status = $model::STATUS_ANSWERED;
            if ($model->save()) {
                $message = new TicketMessages();
                $message->ticket = $model->id;
                $message->message = nl2br($post['message']);
                $message->created_by = $model->updated_by;
                $message->created_at = $model->updated_at;
                $message->uid_admin = \Yii::$app->user->id;


                $message->save();

                // < save file >
                {
                    $uploadDir = \Yii::$app->Options->UploadDir.'/tickets/'.$model->id.'/'.$message->id.'/';
                    if (!empty($_FILES['file']['name'])) {
                        @mkdir($uploadDir, 0777, true);
                        move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir.$_FILES['file']['name']);
                        $message->file = $_FILES['file']['name'];
                        $message->save();
                    }

                }
                // </ save file >

                \Yii::$app->session->addFlash('success', 'پاسخ شما با موفقیت ثبت شد');


                Yii::$app->Notification->send('answerTicket', $model->uid0, $model::className(),
                    [
                        'serial'  => $model->serial,
                        'subject' => $model->subject,
                        'date'    => Yii::$app->functions->convertdatetime($model->updated_at)
                    ]
                );


                return $this->redirect(['/ticket']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ticket model.
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
        parent::init();
        $this->modelClass = new Ticket();
    }

    protected function upload()
    {


    }
}
