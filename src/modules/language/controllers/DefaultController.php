<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\language\controllers;

use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\language\models\SearchLanguage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Language model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    public $enableCsrfValidation = false;
    /**
     * @var $model SearchLanguage
     */
    public $model;


    /**
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new $this->model();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * fine translate directory in module
     * @param $baseModuleDirectory
     * @return false|string
     */
    private function getTranslateDirectory($baseModuleDirectory)
    {
        $messages = realpath($baseModuleDirectory.'/messages');
        $message = realpath($baseModuleDirectory.'/message');
        $translates = realpath($baseModuleDirectory.'/translates');
        $translate = realpath($baseModuleDirectory.'/translate');
        switch (!false) {
            case $message:
                return $message;
            case $messages:
                return $messages;
            case $translate:
                return $translate;
            case $translates:
                return $translates;
            default:
                return false;
        }
    }

    /**
     * Displays a single Language model.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Language::findOne($id);
        $lng = Yii::$app->Language->getLanguages()[strtoupper($model->shortCode)];
        $translates = getFileList(Yii::getAlias('@system/translates/'.$lng->systemCode));

        $modules = Yii::$app->modules;

        $moduleTranslates = [];
        $values = [];
        foreach ($modules as $moduleName => $file) {
            if (is_array($file)) {
                $class = new \ReflectionClass($file['class']);
                $moduleDir = str_replace('Module.php','',$class->getFileName());
            } else {
                $moduleDir = $file->getBasePath();
            }
            $translateDir = $this->getTranslateDirectory($moduleDir);
            if ($translateDir) {
                if ($translateFile = realpath($translateDir.'/'.$lng->systemCode.'/'.$moduleName.'.php')) {
                    $v = [];
                    $v['path'] = $translateFile;
                    $v['values'] = [];
                    $v['name'] = str_replace('.php', '', $moduleName);
                    $i = include_once $v['path'];
                    if (!empty($i)) {
                        $trans = [];
                        foreach ($i as $k => $t) {
                            $trans[hash('crc32', $k)] =
                                [
                                    'key'       => $k,
                                    'translate' => $t
                                ];
                        }
                        $v['values'] = $trans;
                    }
                    $moduleTranslates[$v['name']] = $v;
                }
            }
        }

        foreach ($translates as $item) {

            $v = [];
            $v['path'] = Yii::getAlias('@system/translates/'.$lng->systemCode).'/'.$item['name'];
            $v['values'] = [];
            $v['name'] = str_replace('.php', '', $item['name']);

            $i = include_once $v['path'];
            if (!empty($i)) {
                $trans = [];
                foreach ((array) $i as $k => $t) {
                    $trans[hash('crc32', $k)] =
                        [
                            'key'       => $k,
                            'translate' => $t
                        ];
                }
                $v['values'] = $trans;
            }
            $moduleTranslates[$v['name']] = $v;

        }

        $post = Yii::$app->request->post();
        if (!empty($post)) {
            foreach ($post as $key => $item) {
                $final = [];
                $itemOriginal = $moduleTranslates[$key];
                foreach ($item as $hash => $translate) {
                    $final[$itemOriginal['values'][$hash]['key']] = $translate;
                }
                $file = fopen(
                    $itemOriginal['path'],
                    'w+'
                );
                fwrite($file, $this->generatePHPFile_array($final));
                fclose($file);
            }

            // < Remove Language Cache >
            {
                foreach (Yii::$aliases as $alias) {

                    if (is_array($alias) || is_object($alias)) {
                        continue;
                    }
                    $path = Yii::getAlias($alias).'/runtime/tmp/'.$lng->systemCode.'/translates.php';
                    if (realpath($path)) {

                        unlink($path);
                    }
                }
            }
            // </ Remove Language Cache >

        }


        return $this->render('view', [
            'model' => $model,
            'files' => $moduleTranslates
        ]);
    }

    public function generatePHPFile_array($array)
    {
        $json = "<?php \n return \n".json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return str_replace([
                '":',
                '{',
                '}'
            ], [
                '"=>',
                '[',
                ']'
            ], $json).";";

    }

    /**
     * Creates a new Language model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new $this->model();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->Language->reBuild();
                $model->saveImage('image');
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
     * Updates an existing Language model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->saveImage('image');
            if ($model->save()) {
                Yii::$app->Language->reBuild();
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
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lng = null)
    {
        if (($this->model = Language::findOne($id)) !== null) {
            return $this->model;
        }

        throw new NotFoundHttpException(Yii::t('language', 'The requested page does not exist.'));
    }

    /**
     * Deletes an existing Language model.
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

    public function actionTranslate($source, $target, $text)
    {

        $response = self::requestTranslation($source, $target, $text);
        $translation = self::getSentencesFromJSON($response);
        return $translation;
    }

    protected static function requestTranslation($source, $target, $text)
    {
        $url = "https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=es-ES&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e";
        $fields = [
            'sl' => urlencode($source),
            'tl' => urlencode($target),
            'q'  => urlencode($text)
        ];

        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key.'='.$value.'&';
        }

        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

    protected static function getSentencesFromJSON($json)
    {
        $sentencesArray = json_decode($json, true);
        $sentences = "";
        foreach ($sentencesArray["sentences"] as $s) {
            if (!empty($s["trans"])) {
                $sentences .= $s["trans"];
            }
        }
        return $sentences;
    }

    public function init()
    {
        parent::init();
        $this->model = new SearchLanguage();
    }

    protected function upload()
    {


    }
}
