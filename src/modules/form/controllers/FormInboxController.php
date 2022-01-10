<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\form\controllers;

use YiiMan\YiiBasics\modules\form\models\Form;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\form\models\FormInbox;
use YiiMan\YiiBasics\modules\form\models\SearchFormInbox;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormInboxController implements the CRUD actions for FormInbox model.
 */
class FormInboxController extends \YiiMan\YiiBasics\lib\Controller
{
    public $hasLanguage = false;
    public $formId;

    /**
     * @var $model SearchFormInbox
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
     * Lists all FormInbox models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SearchFormInbox();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $_GET['formId']);
        $form = Form::findOne($_GET['formId']);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'form'         => $form
        ]);
    }

    /**
     * Displays a single FormInbox model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /**
         * @var $model FormInbox
         */
        $model = $this->findModel($id);
        $model->status = FormInbox::STATUS_SEEN;
        $model->save();
        $dataArray = [];
        // < Calculate Data >
        {
            $fields = json_decode($model->form0->details);
            $mapped=[];
            foreach ($fields as $name => $data){
                $mapped[isset($data->name)?$data->name:uniqid()]=$data;
            }
            $fields=$mapped;

            $inboxData = json_decode($model->details);

            if (!empty($inboxData)) {
                foreach ($inboxData as $name => $val) {
                    if ($name == 'formId') {
                        continue;
                    }
                    $data = $fields[$name];
                    switch ($data->type) {
                        case 'autocomplete':
                        case 'text':
                        case 'textarea':
                        case 'number':
                            $dataArray[$data->label] = $val;
                            break;
                        case 'radio-group':
                        case 'checkbox-group':
                            $data->values = ArrayHelper::index($data->values, 'value');

                            $dataArray[$data->label] = '';
                            if (!empty($val) && is_array($val)) {
                                foreach ($val as $v) {
                                    $dataArray[$data->label] .= $data->values[$v]->label.',';
                                }
                            }else{
                                $dataArray[$data->label] .= $data->values[$val]->label.',';
                            }
                            break;
                        case 'date':
                            $dataArray[$data->label] = Yii::$app->functions->convertdate($val);
                            break;
                        case 'file':
                            $dataArray[$data->label] = '<p><a target="_blank" href="'.Yii::$app->Options->UploadUrl.'/dl/form/'.$val.'">'.$val.'</a></p>';
                            break;
                        case 'select':
                            $data->values = ArrayHelper::index($data->values, 'value');
                            if ($data->multiple && is_array($val)) {
                                $dataArray[$data->label] = '';
                                if (!empty($val) && is_array($val)) {
                                    foreach ($val as $v) {
                                        $dataArray[$data->label] .= $data->values[$v]->label.',';
                                    }
                                }else{
                                    $dataArray[$data->label] .= $data->values[$val]->label.',';
                                }
                            } else {
                                $dataArray[$data->label] = $data->values[$val]->label;
                            }
                            break;
                        case 'button':
                        case 'header':
                        case 'paragraph':
                        case 'hidden':

                            break;
                    }


                }
            }


        }
        // </ Calculate Data >

        return $this->render('view', [
            'model'     => $model,
            'dataArray' => $dataArray
        ]);
    }

    /**
     * Creates a new FormInbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormInbox;

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
     * Updates an existing FormInbox model.
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
     * Deletes an existing FormInbox model.
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

        $this->modelClass = new FormInbox();
    }

    protected function upload()
    {


    }
}
