<?php


namespace YiiMan\YiiBasics\modules\logs\controllers;


use YiiMan\YiiBasics\lib\imageManager\Exception\NotFoundException;
use YiiMan\YiiBasics\modules\logs\models\Log;
use yii\data\ArrayDataProvider;
use yii\debug\FlattenException;
use yii\debug\Module;
use yii\web\NotFoundHttpException;

class DefaultController extends \YiiMan\YiiBasics\lib\Controller
{
    

    /**
     * @var array log messages extracted to array as models, to use with data provider.
     */
    private $_models;


    /**
     * @var string panel unique identifier.
     * It is set automatically by the container module.
     */
    public $id;
    /**
     * @var string request data set identifier.
     */
    public $tag;
    /**
     * @var Module
     */
    public $module;
    /**
     * @var mixed data associated with panel
     */
    public $data;
    /**
     * @var array array of actions to add to the debug modules default controller.
     * This array will be merged with all other panels actions property.
     * See [[\yii\base\Controller::actions()]] for the format.
     */
    public $actions = [];

    /**
     * @var FlattenException|null Error while saving the panel
     * @since 2.0.10
     */
    protected $error;


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new \yii\debug\models\search\Log();
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams(), $this->getModels());

        return \Yii::$app->view->render('@vendor/yiisoft/yii2-debug/src/panels/log/detail.php', [
            'dataProvider' => $dataProvider,
            'panel' => $this,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Returns an array of models that represents logs of the current request.
     * Can be used with data providers, such as \yii\data\ArrayDataProvider.
     *
     * @param bool $refresh if need to build models from log messages and refresh them.
     * @return array models
     */
    protected function getModels($refresh = false)
    {
        if ($this->_models === null || $refresh) {
            $this->_models = [];

            foreach ($this->data['messages'] as $message) {
                $this->_models[] = [
                    'message' => $message[0],
                    'level' => $message[1],
                    'category' => $message[2],
                    'time' => $message[3] * 1000, // time in milliseconds
                    'trace' => isset($message[4]) ? $message[4] : [],
                ];
            }
        }

        return $this->_models;
    }

    /**
     * @param string $slug
     * @param string $stamp
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug, $stamp = null)
    {
        $log = $this->find($slug, $stamp);
        if ($log->isExist) {
            return \Yii::$app->response->sendFile($log->fileName, $log->downloadName, ['inline' => true]);
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }

    public function actionArchive($slug)
    {
        if ($this->find($slug, null)->archive(date('YmdHis'))) {
            return $this->redirect(['history', 'slug' => $slug]);
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }

    public function actionHistory($slug)
    {
        $log = $this->find($slug, null);

        return $this->render('history', [
            'name' => $log->name,
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $this->module->getHistory($log),
                'sort' => [
                    'attributes' => [
                        'fileName',
                        'size' => ['default' => SORT_DESC],
                        'updatedAt' => ['default' => SORT_DESC],
                    ],
                    'defaultOrder' => ['updatedAt' => SORT_DESC],
                ],
            ]),
        ]);
    }

    /**
     * @param string $slug
     * @param null|string $stamp
     * @return Log
     * @throws NotFoundHttpException
     */
    protected function find($slug, $stamp)
    {
        if ($log = $this->module->findLog($slug, $stamp)) {
            return $log;
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }
}