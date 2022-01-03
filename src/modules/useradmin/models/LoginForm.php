<?php
	
	namespace YiiMan\YiiBasics\modules\useradmin\models;
	
	use YiiMan\YiiBasics\modules\useradmin\models\User;
	use Yii;
	use yii\base\Model;
	use yii\web\BadRequestHttpException;
	
	/**
	 * Class LoginForm
	 * @property string $email
	 * @property string $password
	 * @property string $rememberMe
	 * @package YiiMan\YiiBasics\modules\useradmin\models
	 */
	class LoginForm extends Model {
		public $email;
		public $password;
		public $rememberMe = true;
		private $_user;
		
		public function rules() {
			return [
				[
					[ 'email' , 'password' ] ,
					'required' ,
					'message' => Yii::t( 'useradmin' , 'this field cannot be blank' )
				] ,
				[ 'rememberMe' , 'boolean' ] ,
				[ [ 'email' , 'password' ] , 'trim' ] ,
				[ 'email' , 'email' ] ,
				[ 'password' , 'validatePassword' ] ,
			
			];
		}
		
		public function attributeLabels() {
			return [
				'email'      =>  Yii::t( 'useradmin' , 'email' )  ,
				'password'   =>  Yii::t( 'useradmin' , 'password' )  ,
				'rememberMe' => Yii::t( 'useradmin' , 'Remember Me'  ) ,
			];
		}
		
		public function validatePassword( $attribute , $params ) {
			if ( ! $this->hasErrors() ) {
				$user = $this->getUser();
				if ( ! $user || ! $user->validatePassword( $this->password ) ) {
					$this->addError( $attribute , Yii::t( 'useradmin' , 'Incorrect email or password.' ) );
				}
			}
		}
		
		public function login() {

			if ( $this->validate() ) {

				return Yii::$app->user->login( $this->getUser() , $this->rememberMe ? 3600 * 24 * 30 : 0 );
			} else {

				return false;
			}
		}
		
		protected function getUser() {
			if ( $this->_user === null ) {
				$this->_user = User::findByEmail( $this->email );
			}
			
			return $this->_user;
		}
		
		
		/**
		 * this function will sent verification code with sms
		 */
		public function sendCode() {
			$mobile  = $this->email;
			$test    = stripos( $mobile , '0' );
			$user    = User::findOne( [ 'username' => $mobile ] );
			$randNum = rand( 1111 , 9999 );
			$exist   = User::findOne( [ 'verification' => $randNum ] );
			
			
			if ( ! empty( $exist ) ) {
				$this->sendCode();
			} else {
				$user->verification = (string) $randNum;
				$user->save();
				
				
				Yii::$app->sms->VerifyLookup( $mobile , $randNum , '' , '' , 'login' );
				
				return true;
			}
		}
		
		/**
		 * @return array
		 * @throws \yii\web\BadRequestHttpException
		 */
		public function verify() {
			
			/* < Out Model > */
			{
				$out =
					[
						'message' => 'success' ,
						'code'    => 200
					];
			}
			/* </ Out Model > */
			
			/* < Check Posted DaTA > */
			{
				if ( empty( Yii::$app->request->post()['code'] ) ) {
					throw new BadRequestHttpException( 'استفاده ی نادرست از توابع مدل اعتبار سنجی کاربر' );
				}
			}
			/* </ Check Posted DaTA > */
			
			$code = Yii::$app->request->post()['code'];
			$user = User::findOne( [ 'verification' => $code ] );
			
			/* < Code is Valid > */
			
			if ( ! empty( $user ) ) {
				$user->verification = null;
				$user->status       = User::STATUS_ACTIVE;
				$user->save();
				$user->login( $user );
				
				return $out;
			}
			
			/* </ Code is Valid > */
			
			/* < Code Is Not Valid > */
			
			else {
				$out['code']    = 404;
				$out['message'] = 'کد اعتبارسنجی اشتباه است';
				
				return $out;
			}
			
			/* </ Code Is Not Valid > */
			
			
		}
		
		public function CheckMobile() {
			$user = User::findOne( [ 'username' => $this->username ] );
			if ( empty( $user ) ) {
				$user           = new User();
				$user->username = $this->username;
				$user->name     = $this->name;
				$user->family   = $this->family;
				/* < موقتی > */
				{
					$user->score  = 200;
					$user->credit = 4000000;
				}
				/* </ موقتی > */
				$user->generateAuthKey();
				$user->setPassword( $this->password );
				$user->status     = User::STATUS_ACTIVE;
				$user->created_at = date( 'Y-m-d' );
				$user->updated_at = date( 'Y-m-d' );
				
				return $user->save();
			} else {
				return true;
			}
		}
	}
