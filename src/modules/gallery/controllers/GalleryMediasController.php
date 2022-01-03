<?php

namespace YiiMan\YiiBasics\modules\gallery\controllers;

use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;
use YiiMan\YiiBasics\modules\gallery\models\SearchGalleryMedias;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * GalleryMediasController implements the CRUD actions for GalleryMedias model.
 */
class GalleryMediasController extends \YiiMan\YiiBasics\lib\Controller
{
    /**
     *
     * @var $model SearchGalleryMedias
     */
    public $model;
    public $enableCsrfValidation = false;

    /**
     * Lists all GalleryMedias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGalleryMedias();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryMedias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!empty($_GET['lng'])) {
            $model = $this->findModel($id, $_GET['lng']);
        } else {
            $model = $this->findModel($id);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new GalleryMedias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryMedias;

        if ($model->load(Yii::$app->request->post())) {
            $language = Language::find()->where(['default' => 1])->one();
            $model->language = $language->id;
            if ($model->save()) {
                $model->saveImage('image');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GalleryMedias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!empty($_GET['lng'])) {
            $model = $this->findModel($id, $_GET['lng']);
        } else {
            $model = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->saveImage('image');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GalleryMedias model.
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


    protected function upload()
    {


    }

    public function actionUpload()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->queryParams;
        $post = Yii::$app->request->post();
        $files = $_FILES;
        $count = 1;
        if (!empty($post) && !empty($files)) {

            foreach ($files as $modelClass => $file) {
                $attribute = array_keys($file['name'])[0];
                $path = Yii::$app->Options->UploadDir . '/tmp/' . Yii::$app->user->id . '/' . $modelClass;
                if (!realpath($path)) {
                    @mkdir($path, 0777, true);
                }
                $fileName = uniqid();


                $fileExtension = explode('.', is_array($file['name'][$attribute]) ? $file['name'][$attribute][0] : $file['name'][$attribute]);
                if (empty($fileExtension)) {
                    $fileExtension = '';
                } else {
                    $fileExtension = '.' . $fileExtension[count($fileExtension) - 1];
                }
                move_uploaded_file(is_array($file['tmp_name'][$attribute]) ? $file['tmp_name'][$attribute][0] : $file['tmp_name'][$attribute], $path . '/' . $fileName . $fileExtension);
                $cookie = Yii::$app->cookie->tmpFiles;
                $cookie2 = Yii::$app->cookie->tmpFiles;
                // < Empty Expired Data >
                {
                    if (count(ArrayHelper::toArray($cookie)) > 11) {

                        $tmp = Yii::$app->Options->UploadDir . '/tmp/';
                        $files = getFileList($tmp); // get all file names
                        if (!empty($files)) {
                            foreach ($files as $userDir) { // iterate files
                                $ClassDirs = getFileList($tmp . '/' . $userDir['name']);
                                if (!empty($ClassDirs)) {
                                    foreach ($ClassDirs as $classDir) {
                                        $tempFFiles = getFileList($tmp . '/' . $userDir['name'] . '/' . $classDir['name']);
                                        if (!empty($tempFFiles)) {
                                            foreach ($tempFFiles as $f) {
                                                $fName = $tmp . $userDir['name'] . '/' . $classDir['name'] . '/' . $f['name'];
                                                @unlink($fName);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        Yii::$app->cookie->tmpFiles = null;
                    }
                }
                // </ Empty Expired Data >

                if (empty($cookie)) {
                    $tmpFile =
                        [
                            'fileName' => $fileName,
                            'fileExtension' => $fileExtension,
                            'created_at' => time(),
                            'maxcount' => !empty($get['maxcount']) ? $get['maxcount'] : 1,
                            'id' => !empty($get['id']) ? $get['id'] : '',
                            'model' => $modelClass,
                            'attr' => $attribute,
                            'type' => is_array($file['type'][$attribute]) ? $file['type'][$attribute][0] : $file['type'][$attribute],
                            'size' => is_array($file['size'][$attribute]) ? $file['size'][$attribute][0] : $file['size'][$attribute],
                        ];
                    $tmpFiles = [];
                    $tmpFiles[] = $tmpFile;
                    Yii::$app->cookie->tmpFiles = $tmpFiles;
                } else {

                    $expired = false;

                    foreach (ArrayHelper::toArray($cookie) as $ckey => $item) {

                        if ($item['model'] == $modelClass) {
                            $lastTime = strtotime('-5 minutes');

                            if ($item['created_at'] < $lastTime) {
                                $expired = true;
                                unset($cookie2[$ckey]);
                                Yii::$app->cookie->tmpFiles = $cookie2;
                            }

                            if ($expired) {
                                $files = glob($path . '/*'); // get all file names
                                foreach ($files as $f) { // iterate files
                                    if (is_file($f)) {
                                        if ($path . '/' . $fileName . $fileExtension == $f) {
                                            continue;
                                        }
                                        @unlink($f); // delete file
                                    }
                                }

                                $tmpFile =
                                    [
                                        'fileName' => $fileName,
                                        'fileExtension' => $fileExtension,
                                        'created_at' => time(),
                                        'model' => $modelClass,
                                        'maxcount' => !empty($get['maxcount']) ? $get['maxcount'] : 1,
                                        'id' => !empty($get['id']) ? $get['id'] : '',
                                        'attr' => $attribute,
                                        'type' => is_array($file['type'][$attribute]) ? $file['type'][$attribute][0] : $file['type'][$attribute],
                                        'size' => is_array($file['size'][$attribute]) ? $file['size'][$attribute][0] : $file['size'][$attribute],
                                    ];
                                $tmpFiles = [];
                                $tmpFiles[] = $tmpFile;
                                Yii::$app->cookie->tmpFiles = $tmpFiles;

                            } else {
                                $tmpFile =
                                    [
                                        'fileName' => $fileName,
                                        'fileExtension' => $fileExtension,
                                        'created_at' => time(),
                                        'maxcount' => !empty($get['maxcount']) ? $get['maxcount'] : 1,
                                        'id' => !empty($get['id']) ? $get['id'] : '',
                                        'model' => $modelClass,
                                        'attr' => $attribute,
                                        'type' => is_array($file['type'][$attribute]) ? $file['type'][$attribute][0] : $file['type'][$attribute],
                                        'size' => is_array($file['size'][$attribute]) ? $file['size'][$attribute][0] : $file['size'][$attribute],
                                    ];

                                $cookie2[] = $tmpFile;
                                Yii::$app->cookie->tmpFiles = $cookie2;
                            }
                        } else {
                            $tmpFile =
                                [
                                    'fileName' => $fileName,
                                    'fileExtension' => $fileExtension,
                                    'created_at' => time(),
                                    'maxcount' => !empty($get['maxcount']) ? $get['maxcount'] : 1,
                                    'id' => !empty($get['id']) ? $get['id'] : '',
                                    'model' => $modelClass,
                                    'attr' => $attribute,
                                    'type' => is_array($file['type'][$attribute]) ? $file['type'][$attribute][0] : $file['type'][$attribute],
                                    'size' => is_array($file['size'][$attribute]) ? $file['size'][$attribute][0] : $file['size'][$attribute],
                                ];
                            $tmpFiles = [];
                            $tmpFiles[] = $tmpFile;
                            Yii::$app->cookie->tmpFiles = ArrayHelper::merge(ArrayHelper::toArray($cookie2), $tmpFiles);
                        }
                    }
                }
            }
        }

        return ['status' => true];
    }


    private function deleteFilesInDir($path)
    {
        $files = glob($path . '/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
    }

    public function actionRemoveMedia()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $src = $post['src'];
        $src = explode('/', $src);
        $src = $src[count($src) - 1];
        $extension = explode('.', $src);
        if (!empty($extension)) {
            unset($extension[count($extension) - 1]);
        }
        $src = $extension;

        $model = GalleryMedias::findOne(['file_name' => $src, 'language_parent' => null]);
        if (!empty($model)) {
            $fileDir = Yii::$app->Options->UploadDir . '/dl/' . $model->className . '/' . $model->file_name . $model->extension;
            @unlink($fileDir);
            $model->delete();
            return ['status' => 'success'];
        }
    }

    public function actionAddDefaultMedia()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $src = $post['src'];
        $src = explode('/', $src);
        $src = $src[count($src) - 1];
        $extension = explode('.', $src);
        if (!empty($extension)) {
            unset($extension[count($extension) - 1]);
        }
        $src = $extension;

        $model = GalleryMedias::findOne(['file_name' => $src, 'language_parent' => null]);
        if (!empty($model)) {

            $models = GalleryMedias::find()->where(['table' => $model->table, 'language' => $model->language, 'table_id' => $model->table_id])->all();

            foreach ($models as $item) {
                $item->default = 0;
                $item->save();
            }
            $model = GalleryMedias::findOne(['file_name' => $src, 'language_parent' => null]);
            $model->default = 1;
            $model->save();

            return ['status' => 'success'];

        }
    }


    public function init()
    {
        parent::init();
        $this->modelClass = new GalleryMedias();
    }
}
