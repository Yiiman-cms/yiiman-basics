<?php
	
	namespace YiiMan\YiiBasics\modules\testimotional\controllers;
	
	use Yii;
	use YiiMan\YiiBasics\modules\testimotional\models\Testimotional;
	use YiiMan\YiiBasics\modules\testimotional\models\SearchTestimotional;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	
	/**
	 * DefaultController implements the CRUD actions for Testimotional model.
	 */
	class DefaultController extends \YiiMan\YiiBasics\lib\Controller {
		/**
		 *
		 * @var $model SearchTestimotional
		 */
		public $model;
		

		
		/**
		 * Lists all Testimotional models.
		 * @return mixed
		 */
		public function actionIndex() {
			$searchModel  = new $this->model();
			$dataProvider = $searchModel->search( Yii::$app->request->queryParams );
			
			return $this->render(
				'index' ,
				[
					'searchModel'  => $searchModel ,
					'dataProvider' => $dataProvider ,
				]
			);
		}
		
		/**
		 * Displays a single Testimotional model.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionView( $id ) {
			return $this->render(
				'view' ,
				[
					'model' => $this->findModel( $id ) ,
				]
			);
		}
		
		/**
		 * Creates a new Testimotional model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate() {
			$model = new Testimotional();
			
			if ( $model->load( Yii::$app->request->post() ) ) {
				$model->created_at=date('Y-m-d H:i:s');
				if ( $model->save() ) {
					$model->saveImage('image');
					
					return $this->redirect( [ 'index' , 'id' => $model->id ] );
				}
			}
			
			return $this->render(
				'create' ,
				[
					'model' => $model ,
				]
			);
		}
		
		/**
		 * Updates an existing Testimotional model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionUpdate( $id ) {
			$model = $this->findModel( $id );
			
			if ( $model->load( Yii::$app->request->post() ) ) {
				
				
				if ( $model->save() ) {
					$model->saveImage('image');
					return $this->redirect( [ 'index' , 'id' => $model->id ] );
				}
			}
			
			return $this->render(
				'update' ,
				[
					'model' => $model ,
				]
			);
		}
		
		/**
		 * Deletes an existing Testimotional model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionDelete( $id ) {
			$this->findModel( $id )->delete();
			
			return $this->redirect( [ 'index' ] );
		}
		
		/**
		 * Finds the Testimotional model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 *
		 * @param integer $id
		 *
		 * @return Testimotional the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel( $id ) {
			if ( ( $this->model = Testimotional::findOne( $id ) ) !== null ) {
				return $this->model;
			}
			
			throw new NotFoundHttpException( Yii::t( 'testimotional' , 'The requested page does not exist.' ) );
		}
		
		protected function upload() {
		
		
		}
		
		public function init() {
			$this->model = new SearchTestimotional();
		}
	}
