<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/25/2020
	 * Time: 03:17 AM
	 */
	
	namespace YiiMan\YiiBasics\validators;
	
	
	use Yii;
	use yii\validators\Validator;
	use function is_numeric;
	use function str_replace;
	use function strlen;
	use function trim;
	
	class Code extends Validator {
		public $length;
		public $delimiter;
		public $target_model;
		public $target_attribute;
		
		public function validateAttribute( $model , $attribute ) {
			$code = $model->{$attribute};
			$code = str_replace( $this->delimiter , '' , $code );
			$code = trim( $code );
			
			if ( ! is_numeric( $code ) ) {
				$this->addError( $model , $attribute , Yii::t( 'validator' , 'code must be numeric' ) );
				
				return false;
			}
			if ( strlen( (string) $code ) < $this->length ) {
				$this->addError(
					$model ,
					$attribute ,
					Yii::t( 'validator' , 'code length is less than {len}' , [ 'len' => $this->length ] )
				);
				
				return false;
			}
			if ( strlen( (string) $code ) > $this->length ) {
				$this->addError(
					$model ,
					$attribute ,
					Yii::t( 'validator' , 'code length is more than {len}' , [ 'len' => $this->length ] )
				);
				
				return false;
			}
			
			
			
			if ( (string) $code  != (string) $this->target_model->{$this->target_attribute} ) {
				$this->addError( $model , $attribute , Yii::t( 'validator' , 'code is invalid' ) );
				
				return false;
			}
			
			return true;
		}
	}
