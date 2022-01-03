<?php

namespace YiiMan\YiiBasics\modules\posttypes\controllers;

use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFk;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesMultiple;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesMultipleFields;
use YiiMan\YiiBasics\widgets\multiRowInput\MultipleInput;
use YiiMan\YiiBasics\widgets\multiRowInput\MultipleInputColumn;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use YiiMan\YiiBasics\modules\posttypes\models\SearchPosttypes;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Posttypes model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{

    public $posttype = '';
    /**
     *
     * @var $model SearchPosttypes
     */
    public $model;

//    /**
//     * {@inheritdoc}
//     */
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
     * Lists all Posttypes models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SearchPosttypes();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // < Calculate Fields >
        {
            foreach ($searchModel::getConfigs()['items'][$this->posttype]['fields'] as $name => $field) {
                switch ($field['type']) {
                    case Posttypes::INPUT_CHECKBOX:
                    case Posttypes::INPUT_MULTI_SELECT:
                    case Posttypes::INPUT_NUMBER:
                    case Posttypes::INPUT_FONTAWESOME_ICON:
                    case Posttypes::INPUT_RADIO:
                    case Posttypes::INPUT_SELECT:
                    case Posttypes::INPUT_DATE:
                    case Posttypes::INPUT_TEXT:
                    case Posttypes::INPUT_TEXTAREA:
                        $searchModel->fields[$name] = '';
                        break;
                }
            }
        }
        // </ Calculate Fields >


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'posttype' => $this->posttype
        ]);
    }

    /**
     * Displays a single Posttypes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $model = $this->loadData($model, $id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Posttypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posttypes;
        $params = Yii::$app->request->queryParams;
        if ($model->load(Yii::$app->request->post())) {

            $model->postType = $params['posttype'];
            $model->created_at = date('Y-m-d H:i:s');
            $user = Yii::$app->user;
            $user = $user->identity;
            $model->created_by = $user->nickName;
            if ($model->save()) {
                $this->saveFields($model);
                return $this->redirect(['/pt/view/' . $model->postType . '/' . $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'form' => empty(Posttypes::getConfigs()['views'][$params['posttype']]['form']) ? null : Posttypes::getConfigs()['views'][$params['posttype']]['form']
        ]);
    }


    /**
     * @param $model Posttypes
     */
    private function saveFields($model)
    {
;
        // < Calculate Fields >
        {

            try{
                foreach ($model->fields as $name => $field) {

                    try{
                        $config = $model::getConfigs(true);
                        $config = $config[$model->postType][$name];
                        switch ($config['type']) {
                            case Posttypes::INPUT_CHECKBOX:
                            case Posttypes::INPUT_MULTI_SELECT:
                            case Posttypes::INPUT_RADIO:
                                if (!empty($field)) {
                                    foreach ($field as $f) {
                                        $fieldModel = PosttypesFields::findOne(['fieldName' => $name, 'posttype' => $model->id, 'content' => $f]);
                                        if (empty($fieldModel)) {
                                            $fieldModel = new PosttypesFields();
                                            $fieldModel->posttype = $model->id;
                                            $fieldModel->content = $f;
                                            $fieldModel->fieldName = $name;
                                            if (!$fieldModel->save()) {
                                                if (!empty($fieldModel->errors)) {

                                                    foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                                        Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                                    }
                                                }
                                            }
                                        } else {
                                            $fieldModel->content = $f;
                                            if (!$fieldModel->save()) {
                                                if (!empty($fieldModel->errors)) {

                                                    foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                                        Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                                break;
                            case Posttypes::INPUT_NUMBER:
                            case Posttypes::INPUT_FONTAWESOME_ICON:
                            case Posttypes::INPUT_TEXT:
                            case Posttypes::INPUT_FROALA:
                            case Posttypes::INPUT_TEXTAREA:
                            case Posttypes::INPUT_MASKED_TEXT:
                            case Posttypes::INPUT_SELECT:
                            case Posttypes::INPUT_DATE:
                                $fieldModel = PosttypesFields::findOne(['posttype' => $model->id, 'fieldName' => $name]);
                                if (empty($fieldModel)) {
                                    $fieldModel = new PosttypesFields();
                                }

                                $fieldModel->posttype = $model->id;
                                $fieldModel->content = (string)$field;
                                $fieldModel->fieldName = $name;
                                if (!$fieldModel->save()) {
                                    if (!empty($fieldModel->errors)) {

                                        foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                            Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                        }
                                    }
                                }

                                break;
                            case Posttypes::INPUT_RELATION_SINGLE:

                                if (!empty($field)) {
                                    $relatedModel = $model->getRelatedModel($name, true);
//                            $relatedModel = PosttypesFields::findOne(['fieldName' => $name, 'posttype' => $model->id]);
                                    if (empty($relatedModel)) {
                                        $model->addRelation($field, $name);
                                    } else {
                                        $relatedModel->posttype_to = (int)$field;
                                        if (!$relatedModel->save()) {
                                            if (!empty($relatedModel->errors)) {
                                                foreach ($relatedModel->getErrorSummary(true) as $keyError => $valError) {
                                                    Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                                }
                                            }
                                        }
                                    }
                                }

                                break;
                            case Posttypes::INPUT_MULTIPLE:

                                if (!empty($field)) {
                                    $fieldModel2 = PosttypesMultiple::find()->where(['posttype_id' => $model->id, 'fieldName' => $name])->all();
                                    if (!empty($fieldModel2)) {
                                        foreach ($fieldModel2 as $i) {
                                            $deleted = $i->delete();
                                            $error = $i->errors;
                                        }
                                    }

                                    foreach ($field as $index => $row) {
                                        foreach ($row as $key => $val) {
                                            try{
                                                $fieldModel2 = new PosttypesMultiple();
                                                $fieldModel2->key = (string)$key;
                                                $fieldModel2->posttype_id = (int)$model->id;
                                                $fieldModel2->posttype = (string)$model->postType;
                                                $fieldModel2->fieldName = (string)$name;
                                                $fieldModel2->type = (string)$config['fields'][$key]['type'];
                                                $fieldModel2->index = (int)$index;


                                                if (is_array($val)) {
                                                    $fieldModel2->save();
                                                    foreach ($val as $valKey => $valval) {
                                                        $mfModel = new PosttypesMultipleFields();
                                                        $mfModel->key = (string)$valKey;
                                                        $mfModel->value = !empty($valval) ? (string)$valval : '';
                                                        $mfModel->posttype_id = (int)$model->id;
                                                        $mfModel->posttype = (string)$model->postType;
                                                        $mfModel->posttype_field_name = (string)$name;
                                                        $mfModel->multiple_field_name = (string)$key;
                                                        $mfModel->multiple_field_id = $fieldModel2->id;
                                                        $mfModel->save();
                                                    }
                                                } else {
                                                    $fieldModel2->value = !empty($val) ? (string)$val : '';
                                                    $fieldModel2->save();
                                                }
                                            }catch (\Exception $e){}

                                        }
                                    }

                                }

                                break;
                        }
                    }
                    catch (\Exception $e){}



                }
            }catch (\Exception $e){}

        }
        // </ Calculate Fields >

    }

    private function loadData($model, $id)
    {

        // < Load Fields >
        {
            $fields = PosttypesFields::find()->select(['fieldName', 'content'])->where(['posttype' => $model->id])->all();

            // < Load relations >
            {
                $relations = PosttypesFk::find()->select(['posttype_to', 'posttype_type_to'])->where(['posttype_from' => $model->id])->asArray()->all();
                if (!empty($relations)) {
                    $relations = ArrayHelper::index($relations, 'posttype_type_to');
                    foreach ($relations as $relName => $rel) {
                        if (!empty($rel['posttype_to'])) {
                            $model->fields[$relName] = $rel['posttype_to'];
                        }
                    }
                }
            }
            // </ Load relations >


            // < load multiple fields >
            {
                $multiples = [];
                $multiples = PosttypesMultiple::find()->where(['posttype_id' => $id])->all();
                if (!empty($multiples)) {
                    $outItem = [];
                    $multiplesfields = ArrayHelper::index($multiples, null, 'fieldName');
                    foreach ($multiplesfields as $fieldName => $rows) {

//                        $row=ArrayHelper::index($rows,null,'index');
                        foreach ($rows as $rowIndex => $item) {
                            /**
                             * @var $item PosttypesMultiple
                             */

                            switch ($item->type) {
                                case MultipleInputColumn::TYPE_HIDDEN_INPUT:
                                case MultipleInputColumn::TYPE_NUMBER_INPUT:
                                case MultipleInputColumn::TYPE_STATIC:
                                case MultipleInputColumn::TYPE_TEXT_INPUT:
                                case MultipleInputColumn::TYPE_CHECKBOX:
                                case MultipleInputColumn::TYPE_DROPDOWN:
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
                                    break;
                                case MultipleInputColumn::TYPE_CHECKBOX_LIST:
                                case MultipleInputColumn::TYPE_RADIO_LIST:
                                    $outItem[$item->fieldName][$item->index][$item->key] = [];
                                    $fieldModelFields = PosttypesMultipleFields::find()->select(['key', 'value'])->where(['multiple_field_id' => $item->id])->asArray()->all();
                                    if (!empty($fieldModelFields)) {
                                        $ar = [];
                                        foreach ($fieldModelFields as $fk => $fv) {
                                            $ar[$fk] = $fv;
                                        }
                                        $outItem[$item->fieldName][$item->index][$item->key] = $ar;
                                    }
                                    break;
                                default:
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
                            }

                        }

                        $model->fields[$fieldName] = $outItem[$fieldName];
                    }

                }
            }
            // </ load multiple fields >

            if (!empty($fields)) {
                $fields = ArrayHelper::index($fields, null, 'fieldName');
                foreach ($fields as $fieldName => $field) {
                    $config = $model::getConfigs(true)[$model->postType];
                    // < اگر نام پارامتر هایی که برای آنها در بانک داده دیتا ثبت شده است تغییر کرده بود، آن پارامتر ها پاک میشوند >
                    {

                        if (!empty($config[$fieldName])) {
                            $config = $config[$fieldName];
                        } else {

                            continue;
                        }
                    }
                    // </ اگر نام پارامتر هایی که برای آنها در بانک داده دیتا ثبت شده است تغییر کرده بود، آن پارامتر ها پاک میشوند >

                    switch ($config['type']) {
                        case Posttypes::INPUT_CHECKBOX:
                        case Posttypes::INPUT_MULTI_SELECT:
                            $model->fields[$fieldName] = ArrayHelper::getColumn($field, 'content');
                            break;
                        case Posttypes::INPUT_SELECT:
                        case Posttypes::INPUT_RADIO:
                        case Posttypes::INPUT_FONTAWESOME_ICON:
                        case Posttypes::INPUT_NUMBER:
                        case Posttypes::INPUT_TEXT:
                        case Posttypes::INPUT_MASKED_TEXT:
                        case Posttypes::INPUT_TEXTAREA:
                        case Posttypes::INPUT_FROALA:
                            $model->fields[$fieldName] = $field[0]->content;
                            break;

                        case Posttypes::INPUT_RELATION_SINGLE:
                            if (!empty($relations[$fieldName])) {
                                $model->fields[$fieldName] = $relations[$fieldName]['posttype_to'];
                            } else {
                                $model->fields[$fieldName] = '';
                            }
                    }
                }
            }

        }
        // </ Load Fields >
        return $model;
    }


    /**
     * Updates an existing Posttypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model = $this->loadData($model, $id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                $this->saveFields($model);

                // < check Unchecked Fields >
                {
                    foreach ($model::getConfigs(true)[$model->postType] as $name => $field) {
                        switch ($field['type']) {
                            case Posttypes::INPUT_CHECKBOX:
                            case Posttypes::INPUT_MULTI_SELECT:
                            case Posttypes::INPUT_RADIO:
                                if (empty($model->fields[$name])) {
                                    $savedOnDb = PosttypesFields::find()->where(['posttype' => $model->id, 'fieldName' => $name])->all();
                                    if (!empty($savedOnDb)) {
                                        foreach ($savedOnDb as $dbModel) {
                                            if (empty($value)) {
                                                $dbModel->delete();
                                            }
                                        }
                                    }
                                } else {
                                    $savedOnDb = PosttypesFields::find()->where(['posttype' => $model->id, 'fieldName' => $name])->all();
                                    if (!empty($savedOnDb)) {
                                        $vals = array_flip($model->fields[$name]);
                                        foreach ($savedOnDb as $dbV) {
                                            if (!isset($vals[$dbV->content])) {
                                                $dbV->delete();
                                            }
                                        }
                                    }

                                }
                                break;
                        }
                    }
                }
                // </ check Unchecked Fields >

                return $this->redirect(['/pt/view/' . $model->postType . '/' . $model->id]);
            }
        }
        $configs = Posttypes::getConfigs();

        return $this->render(
            'update'
            , [
            'model' => $model,
            'form' => empty(Posttypes::getConfigs()['views'][$model->postType]['form']) ? null : Posttypes::getConfigs()['views'][$model->postType]['form']
        ]);
    }

    /**
     * Deletes an existing Posttypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/pt/' . $_GET['posttype']]);
    }


    protected function upload()
    {


    }


    public function init()
    {
        parent::init();
        $this->posttype = $_GET['posttype'];
        $this->modelClass = new Posttypes();
    }
}
