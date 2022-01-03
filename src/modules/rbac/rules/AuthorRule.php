<?php
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:https://yiiman.ir
	 * Date: 03/21/2020
	 * Time: 12:16 PM
	 */
	
	namespace YiiMan\YiiBasics\modules\rbac\rules;
	
	
	use yii\rbac\Rule;
	use yii\rbac\Item;
	use function is_string;
	
	class AuthorRule extends Rule {
		public $name = 'isAuthor';
		
		/**
		 * @param string|int $user   the user ID.
		 * @param Item       $item   the role or permission that this rule is associated with
		 * @param array      $params parameters passed to ManagerInterface::checkAccess().
		 *
		 * @return bool a value indicating whether the rule permits the role or permission it is associated with.
		 */
		public function execute( $user , $item , $params ) {
			return isset( $params['post'] ) ? $params['post']->createdBy == $user : false;
		}
	}
