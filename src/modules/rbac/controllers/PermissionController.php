<?php
	
	namespace YiiMan\YiiBasics\modules\rbac\controllers;
	
	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use yii\web\Response;
	use yii\helpers\Html;
	use YiiMan\YiiBasics\modules\rbac\models\Permission;
	use YiiMan\YiiBasics\modules\rbac\models\PermissionSearch;
	
	/**
	 * PermissionController is controller for manager permissions
	 * @author John Martin <john.itvn@gmail.com>
	 * @since  1.0.0
	 */
	class PermissionController extends Controller {

		
		/**
		 * Lists all Permission models.
		 * @return mixed
		 */
		public function actionIndex() {
			$searchModel  = new PermissionSearch();
			$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

			return $this->render(
				'index' ,
				[
					'searchModel'  => $searchModel ,
					'dataProvider' => $dataProvider ,
				]
			);
		}

		
	}
