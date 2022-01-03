<?php
	
	namespace YiiMan\YiiBasics\modules\testimotional\models;
	
	use YiiMan\YiiBasics\lib\ActiveRecord;
	use Yii;
	use yii\behaviors\TimestampBehavior;
	use yii\web\UploadedFile;
	
	/**
	 * This is the model class for table "{{%module_testimotional}}".
	 *
	 * @property int    $id
	 * @property string $content
	 * @property string $author
	 * @property string $job
	 * @property string $created_at
	 * @property string $updated_at
	 * @property string $image
	 * @property string $status
	 * @property int    $index
	 */
	class Testimotional extends ActiveRecord {
		const STATUS_ACTIVE = 1;
		const STATUS_DE_ACTIVE = 0;
		
		public $fileimg;
		
		/**
		 * {@inheritdoc}
		 */
		public static function tableName() {
			return '{{%module_testimotional}}';
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function rules() {
			return
				[
					[ [ 'content' , 'author' ] , 'required' ] ,
					[ [ 'index' , 'status' ] , 'integer' ] ,
					[ [ 'content' ] , 'string' , 'max' => 500 ] ,
					[ [ 'author' , 'job' , 'fileimg' ] , 'string' , 'max' => 255 ] ,
					[ [ 'created_at' , 'updated_at' ] , 'safe' ] ,
					[ [ 'image' ] , 'file'] ,
				];
		}
		
		public function getImageUrl() {
		
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels() {
			return [
				'id'      => Yii::t( 'testimotional' , 'ID' ) ,
				'content' => Yii::t( 'testimotional' , 'Content' ) ,
				'author'  => Yii::t( 'testimotional' , 'Author' ) ,
				'job'     => Yii::t( 'testimotional' , 'Job' ) ,
				'index'   => Yii::t( 'testimotional' , 'Index' ) ,
				'image'   => Yii::t( 'testimotional' , 'Author Image' ) ,
			];
		}
		
		/**
		 * @return array|\YiiMan\YiiBasics\modules\testimotional\models\Testimotional[]|\yii\db\ActiveRecord[]
		 */
		public static function getAll() {
			return self::find()->where( [ 'status' => self::STATUS_ACTIVE ] )->all();
		}
	}
