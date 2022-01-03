<?php
	
	namespace YiiMan\YiiBasics\modules\useradmin\controllers;
	
	
	use Exception;
	use Yii;
	use YiiMan\YiiBasics\modules\useradmin\models\User;
	use YiiMan\YiiBasics\modules\useradmin\models\SearchUser;
	use yii\helpers\ArrayHelper;
	use yii\web\Controller;
	use yii\web\ForbiddenHttpException;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use yii\web\Response;
	use yii\web\UploadedFile;
	
	/**
	 * DefaultController implements the CRUD actions for User model.
	 */
	class DefaultController extends \YiiMan\YiiBasics\lib\Controller {
		/**
		 *
		 * @var $model SearchUser
		 */
		public $model;
		

		/**
		 * Lists all User models.
		 * @return mixed
		 */
		public function actionIndex() {
			$searchModel  = new SearchUser();
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
		 * Displays a single User model.
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
		 * Creates a new User model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate() {
			/**
			 *
			 * @var $model User
			 */
			$model = new User();
			$post  = Yii::$app->request->post();
			if ( $model->load( $post ) ) {
				$model->created_at=date('Y-m-d H:i:s');
				$model->updated_at=date('Y-m-d H:i:s');
				if ( empty( $model->password ) ) {
					$model->setPassword( 123456 );
				} else {
					$model->setPassword( $model->password );
				}
				$model->generateAuthKey();
				try {
					if ( $model->save() ) {
						
						$model->saveImage( 'image' );
						
						
						return $this->redirect( [ 'index' ] );
					}
				} catch ( Exception $e ) {
					Yii::$app->session->setFlash( 'danger' , $e->getMessage() );
				}
			}
			
			return $this->render(
				'create' ,
				[
					'model' => $model
				]
			);
		}
		
		/**
		 * Updates an existing User model.
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
				$model->updated_at=date('Y-m-d H:i:s');
				if ( $model->save() ) {
					if ( !empty( $model->password ) ) {
						$model->setPassword( $model->password );
					}
					$model->saveImage( 'image' );
					
					return $this->redirect( [ 'index' ] );
				}
			}
			
			return $this->render(
				'update' ,
				[
					'model' => $model
				]
			);
		}
		
		public function actionChangePassword( $id ) {
			$model        = $this->findModel( $id );
			$new_password = rand( 11111 , 99999 );
			$model->setPassword( $new_password );
			
			$messages = '';
			$messages .= 'رمز عبور جدید شما :';
			$messages .= $new_password;
			$messages .= "\n";
			$messages .= 'دهکده پرواز';
			
			if ( $model->save() ) {
				Yii::$app->sms->Send( $model->username , $messages );
				Yii::$app->session->setFlash(
					'success' ,
					"رمز عبور برای $model->name به : $new_password تغییر یافت ."
				);
			}
			
			return $this->render(
				'view' ,
				[
					'model' => $this->findModel( $id ) ,
				]
			);
		}
		
		/**
		 * Deletes an existing User model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 *
		 * @param integer $id
		 *
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionDelete( $id ) {
			$model = $this->findModel( $id );
			if ( $model->superadmin ) {
				throw new ForbiddenHttpException( 'You Can Not Delete SuperAdmin' );
			}
			$model->delete();
			
			return $this->redirect( [ 'index' ] );
		}
		
		public function actionCheckDuplicate() {
			$post                       = Yii::$app->request->post();
			Yii::$app->response->format = Response::FORMAT_JSON;
			if ( ! empty( $post['val'] ) ) {
				$model = User::findOne( [ 'username' => $post['val'] ] );
				if ( ! empty( $model ) ) {
					return [ 'status' => 'duplicate' ];
				}
				
				return [ 'status' => 'not duplicate' ];
			}
		}
		
		/**
		 * Finds the User model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 *
		 * @param integer $id
		 *
		 * @return User the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel( $id,$lng = null ) {
			if ( ( $this->model = User::findOne( $id ) ) !== null ) {
				return $this->model;
			}
			
			throw new NotFoundHttpException( Yii::t( 'user' , 'The requested page does not exist.' ) );
		}
		
		protected function upload() {
		
		
		}
		
		public function init() {
		    parent::init();
			$this->model = new SearchUser();
		}
	}
