<?php

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
     *
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
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Language model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Language::findOne($id);
        $lng = Yii::$app->Language->getLanguages()[strtoupper($model->shortCode)];
        $translates = getFileList(Yii::getAlias('@system/translates/' . $lng->systemCode));

        $modules = getFileList(Yii::getAlias('@system/modules'));

        $moduleTranslates = [];
        $values = [];
        foreach ($modules as $file) {
            if ($file['type'] != 'dir') {
                continue;
            }

            if (file_exists(Yii::getAlias('@system/modules') . '/' . $file['name'] . '/translates/' . $lng->systemCode . '/' . $file['name'] . '.php')) {
                $v = [];
                $v['path'] = Yii::getAlias('@system/modules') . '/' . $file['name'] . '/translates/' . $lng->systemCode . '/' . $file['name'] . '.php';;
                $v['values'] = [];
                $v['name'] = str_replace('.php', '', $file['name']);
                $i = include_once $v['path'];
                if (!empty($i)) {
                    $trans = [];
                    foreach ($i as $k => $t) {
                        $trans[hash('crc32', $k)] =
                            [
                                'key' => $k,
                                'translate' => $t
                            ];
                    }
                    $v['values'] = $trans;
                }
                $moduleTranslates[$v['name']] = $v;
            }
        }

        foreach ($translates as $item) {

            $v = [];
            $v['path'] = Yii::getAlias('@system/translates/' . $lng->systemCode) . '/' . $item['name'];
            $v['values'] = [];
            $v['name'] = str_replace('.php', '', $item['name']);

            $i = include_once $v['path'];
            if (!empty($i)) {
                $trans = [];
                foreach ((array)$i as $k => $t) {
                    $trans[hash('crc32', $k)] =
                        [
                            'key' => $k,
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
                    $final[$itemOriginal['values'][$hash]['key']]=$translate;
                }
                $file = fopen(
                    $itemOriginal['path'] ,
                    'w+'
                );
                fwrite( $file , $this->generatePHPFile_array( $final ) );
                fclose( $file );
            }

            // < Remove Language Cache >
            {
                foreach (Yii::$aliases as $alias){

                    if (is_array($alias) || is_object($alias)){
                        continue;
                    }
                    $path=Yii::getAlias($alias).'/runtime/tmp/'.$lng->systemCode.'/translates.php';
                    if (realpath($path)){

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

    public function generatePHPFile_array( $array ) {
        $json = "<?php \n return \n" . json_encode( $array , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

        return str_replace( [ '":' , '{' , '}' ] , [ '"=>' , '[' , ']' ] , $json ) . ";";

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
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Language model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Language model.
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

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
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


    protected function upload()
    {


    }



    public  function actionTranslate($source, $target, $text) {

        $response 		= self::requestTranslation($source, $target, $text);
        $translation 	= self::getSentencesFromJSON($response);
        return $translation;
    }

    protected static function requestTranslation($source, $target, $text) {
        $url = "https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=es-ES&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e";
        $fields = array(
            'sl' => urlencode($source),
            'tl' => urlencode($target),
            'q' => urlencode($text)
        );

        $fields_string = "";
        foreach($fields as $key=>$value) {
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
        curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

    protected static function getSentencesFromJSON($json) {
        $sentencesArray = json_decode($json, true);
        $sentences = "";
        foreach ($sentencesArray["sentences"] as $s) {
            if (!empty($s["trans"])){
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
}
