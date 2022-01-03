<?php

namespace YiiMan\YiiBasics\modules\seo\controllers;

use YiiMan\YiiBasics\modules\seo\models\SeoFlags;
use Yii;
use YiiMan\YiiBasics\modules\seo\models\SeoFlagContents;
use YiiMan\YiiBasics\modules\seo\models\SearchSeoFlagContents;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for SeoFlagContents model.
 */
class DefaultController extends \YiiMan\YiiBasics\lib\Controller{
    public $hasLanguage=true;
	/**
	*
	* @var $model SearchSeoFlagContents	*/
	public $model;


    /**
     * Lists all SeoFlagContents models.
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
     * Displays a single SeoFlagContents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SeoFlagContents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeoFlagContents();
		
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				if (empty( $model->slug)){
					$model->slug=urlencode($model->title);
					$model->save();
				}
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SeoFlagContents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			if( $model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SeoFlagContents model.
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





	protected function upload(){
	
	
	}


	public function init(){
        parent::init();
        $this->modelClass=SeoFlagContents::className();
		$this->model=new SearchSeoFlagContents();
	}
}
