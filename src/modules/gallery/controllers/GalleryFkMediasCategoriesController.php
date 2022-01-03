<?php

namespace YiiMan\YiiBasics\modules\gallery\controllers;

use Yii;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\gallery\models\GalleryFkMediasCategories;
use YiiMan\YiiBasics\modules\gallery\models\SearchGalleryFkMediasCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryFkMediasCategoriesController implements the CRUD actions for GalleryFkMediasCategories model.
 */
class GalleryFkMediasCategoriesController extends \YiiMan\YiiBasics\lib\Controller{
	/**
	*
	* @var $model SearchGalleryFkMediasCategories	*/
	public $model;


    /**
     * Lists all GalleryFkMediasCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGalleryFkMediasCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryFkMediasCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!empty($_GET['lng'])){
            $model=$this->findModel($id,$_GET['lng']);
        }else{
            $model=$this->findModel($id);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new GalleryFkMediasCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryFkMediasCategories;

        if ($model->load(Yii::$app->request->post())) {
            $language=Language::find()->where(['default'=>1])->one();
            $model->language=$language->id;
            if($model->save()){
                $model->saveImage( 'image');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GalleryFkMediasCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!empty($_GET['lng'])){
            $model=$this->findModel($id,$_GET['lng']);
        }else{
            $model=$this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->saveImage( 'image');
            if( $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GalleryFkMediasCategories model.
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
		$this->modelClass=new GalleryFkMediasCategories();
	}
}
