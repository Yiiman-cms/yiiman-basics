<?php
	
	namespace YiiMan\YiiBasics\modules\seo\models;
	
	use YiiMan\YiiBasics\lib\ActiveRecord;
    use Yii;
	
	/**
	 * This is the model class for table "{{%module_seo_flags}}".
	 *
	 * @property int                                        $id      شناسه ی خصوصی
	 * @property string                                     $flag    پرچم
	 * @property int                                        $content محتوی
	 * @property \YiiMan\YiiBasics\modules\seo\models\SeoFlagContents $content0
	 */
	class SeoFlags extends ActiveRecord {
		/**
		 * {@inheritdoc}
		 */
		public static function tableName() {
			return '{{%module_seo_flags}}';
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function rules() {
			return [
				[ [ 'content' ] , 'integer' ] ,
				[ [ 'flag' ] , 'string' , 'max' => 255 ] ,
			];
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels() {
			return [
				'id'      => Yii::t( 'seo' , 'شناسه ی خصوصی' ) ,
				'flag'    => Yii::t( 'seo' , 'پرچم' ) ,
				'content' => Yii::t( 'seo' , 'محتوی' ) ,
			];
		}
		
		/**
		 * @return array|null|\YiiMan\YiiBasics\modules\seo\models\SeoFlags|\yii\db\ActiveRecord
		 */
		public function getContent0() {
			$model=SeoFlagContents::findOne( [$this->content]);
			
			
			return $model;
		}
	}
