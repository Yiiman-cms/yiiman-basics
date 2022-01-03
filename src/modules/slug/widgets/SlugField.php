<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:https://yiiman.ir
	 * Date: ۰۲/۲۲/۲۰۲۰
	 * Time: ۱۶:۱۴ بعدازظهر
	 */
	
	namespace YiiMan\YiiBasics\modules\slug\widgets;
	
	
	use kartik\base\InputWidget;
	use YiiMan\YiiBasics\modules\slug\controllers\DefaultController;
	use YiiMan\YiiBasics\modules\slug\widgets\SlugInputWidget;
	use YiiMan\YiiBasics\modules\slug\models\Slug;
	use Yii;
	use yii\bootstrap\ActiveForm;
	
	class SlugField {
		/**
		 * @param $model \yii\db\ActiveRecord
		 *
		 * @return \yii\bootstrap\ActiveField
		 * @throws \Exception
		 */
		public static function run($form, $model ) {
			
			$slugModel = new Slug();
			if (!empty( $model)){
				$slugModel=Slug::findOne( ['table_id'=>$model->id,'table_name'=>$model::tableName()]);
				$tablename=$model::tableName();
//				$query=<<<SQL
//select * from module_slug where table_name='{$tablename}' and table_id={$model->id}
//SQL;
//
//				$slugModel=Yii::$app->db->createCommand($query)->queryOne();
				
				
				if (empty( $slugModel)){
					$slugModel = new Slug();
				}
			}
			if (!empty( $_POST['Slug']['slug'])){
				$slugModel->slug=$_POST['Slug']['slug'];
			}
			return $form->field( $slugModel , 'slug' )->widget(SlugInputWidget::className(),['origModel'=>$model]);
			
		}
	}
