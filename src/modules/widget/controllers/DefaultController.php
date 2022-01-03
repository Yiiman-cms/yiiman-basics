<?php

namespace YiiMan\YiiBasics\modules\widget\controllers;

use YiiMan\YiiBasics\lib\hquery\hQuery;
use YiiMan\YiiBasics\modules\widget\models\Components;
use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\widget\models\Widget;
use YiiMan\YiiBasics\modules\widget\models\SearchWidget;
use yii\db\Migration;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Widget model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     *
     * @var $model SearchWidget
     */
    public $model;

    /**
     * Lists all Widget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $files = getFileList(Yii::getAlias('@system') . '/theme/pageSchema');


        $searchModel = new SearchWidget();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'files' => $files
        ]);
    }

    /**
     * Displays a single Widget model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($loc)
    {

        $model = $this->findModel($loc);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Widget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($loc)
    {
        $model = new Widget;
        $model->shortCode=$loc;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash('success','ویجت با موفقیت ایجاد شد');
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Finds the Skills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $lng
     * @param integer $id
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($loc, $lng = null)
    {
        $parentLoc=Widget::find()->where(['shortCode'=>$loc,'language_parent'=>null])->one();

        if (empty($lng) && !empty($_GET['lng'])) {
            $lng = $_GET['lng'];
        }
        // < check language >
        {
            if (empty($this->modelClass)) {
                throw new BadRequestHttpException('modelClass را در کنترلر پر کنید');
            }

            if (!empty($this->modelClass)) {
                $mclass = new $this->modelClass();
                if (!$mclass->hasAttribute('language')) {
                    if ($this->hasLanguage) {
                        $mig = new Migration();

                        $mig->addColumn($mclass::tableName(), 'language', $mig->integer());
                        $mig->addColumn($mclass::tableName(), 'language_parent', $mig->integer());
                        unset($mig);
                    }
                    unset($mclass);
                }
            }
        }
        // </ check language >

        if (empty($lng)) {
            // < زبانی برای جست و جو به مدل داده نشده است >
            {
                if (($this->model = $this->modelClass::findOne(['shortCode'=>$loc])) !== null) {
                    return $this->model;
                }
            }
            // </ زبانی برای جست و جو به مدل داده نشده است >
        } else {
            // < آی دی یک زبان اعلام شده >
            {
                $this->model = $this->modelClass::find()->where(['shortCode'=>$loc, 'language' => $lng])->one();
                if (empty($this->model)) {
                    // < آی دی ارائه شده زبان درخواست شده را در بانک داده ندارد >
                    {
                        $this->model = $this->modelClass::find()->where(['language_parent' => $parentLoc->id, 'language' => $lng])->one();
                    }
                    // </ آی دی ارائه شده زبان درخواست شده را در بانک داده ندارد >
                }
                if (empty($this->model)) {
                    // < زبان و آی دی مورد نظر هنوز پیدا نشده است >
                    {
                        $baseModel = $this->modelClass::find()->where(['shortCode' => $loc, 'language_parent' => null])->one();
                        if (empty($baseModel)) {
                            $baseModel = $this->modelClass::find()->where(['shortCode' => $loc])->one();
                            if (!empty($baseModel)) {
                                if (!empty($baseModel->language_parent)) {
                                    $redirectUrl = str_replace(
                                        [
                                            '?id=' . $_GET['id'],
                                            '&id=' . $_GET['id'],
                                        ],
                                        [
                                            '?id=' . $baseModel->language_parent,
                                            '&id=' . $baseModel->language_parent,
                                        ], Yii::$app->request->url);
                                    header('Location: ' . $redirectUrl);
                                    exit();
                                }
                            }
                        }
                        if (empty($baseModel)) {
                            throw new NotFoundHttpException(Yii::t('skills', 'The requested page does not exist.'));
                        } else {
                            $newModel = new $this->modelClass();
                            foreach ($newModel->attributes as $attribute => $val) {
                                if ($attribute == 'language') {
                                    $newModel->language = $lng;
                                    continue;
                                }
                                if ($attribute == 'language_parent') {
                                    $newModel->$attribute = $parentLoc->id;
                                    continue;
                                }
                                if ($attribute == 'id') {
                                    continue;
                                }

                                $newModel->$attribute = $baseModel->$attribute;
                            }
                            $newModel->save();
                            return $newModel;
                        }
                    }
                    // </ زبان و آی دی مورد نظر هنوز پیدا نشده است >
                } else {
                    return $this->model;
                }
            }
            // </ آی دی یک زبان اعلام شده >

        }
    }



    /**
     * Updates an existing Widget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($loc)
    {
        $model = $this->findModel($loc);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash('success','ویجت با موفقیت ویرایش شد');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Widget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLayout($mode = 'json',$layout='',$model='')
    {
        if ($mode == 'json') {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        $content = '<MMODELwidget><content></content></MMODELwidget>';
        if (!empty($layout)){
            $fullHTML = $this->renderPartial('@frontend/views/layouts/'.$layout.'.php', ['content' => $content,'model'=>$model]);
        }else{
            $fullHTML = $this->renderPartial('@frontend/views/layouts/main.php', ['content' => $content]);
        }


        $doc = hQuery::fromHTML($fullHTML);
        $bodyContent = $doc->find('body')->html();
        $widgetHTML = str_replace($bodyContent, '<MMODELwidget><content></content></MMODELwidget>', $fullHTML);

//        $widgetHTML = preg_replace("/<body[^>]*>(.*?)<\/body>/is", '<MMODELwidget></MMODELwidget>', $fullHTML);


        // < add Styles >
        {
            if (!empty(Components::$styles['full'])) {
                $fullHTML = '<style>' . Components::$styles['full'] . '</style>' . $fullHTML;
            }

            if (!empty(Components::$styles['widget'])) {
                $widgetHTML = '<style>' . Components::$styles['widget'] . '</style>' . $widgetHTML;
            }
        }
        // </ add Styles >


        return ['full' => $fullHTML, 'widget' => $widgetHTML];
    }

    protected function upload()
    {


    }

    public function init()
    {
        parent::init();
        $this->modelClass = new Widget();
    }
}
