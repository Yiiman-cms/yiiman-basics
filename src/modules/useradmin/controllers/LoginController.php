<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: ۰۲/۰۴/۲۰۲۰
 * Time: ۰۳:۴۰ بعدازظهر
 */

namespace YiiMan\YiiBasics\modules\useradmin\controllers;

use YiiMan\YiiBasics\lib\Controller;
use YiiMan\YiiBasics\modules\rbac\models\Provider;
use YiiMan\YiiBasics\modules\useradmin\models\LoginForm;
use YiiMan\YiiBasics\modules\useradmin\models\User;
use Yii;
use yii\filters\AccessControl;

class LoginController extends Controller
{

    public $layout = '@system/modules/useradmin/views/layouts/main.php';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' =>
                [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'index',
                                'error'
                            ],
                            'allow'   => true,
                        ],
                        [
                            'actions' => ['logout'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
//				'verbs'  => [
//					'class'   => VerbFilter::className() ,
//					'actions' => [
//						'logout' => [ 'post' ] ,
//					] ,
//				] ,
        ];
    }

    public function actionIndex()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['dashboard/index']);
        }
        // < check exist user >
        {
            $userModel = User::findOne(1);
            if (empty($userModel)) {
                $userModel = new User();
                $userModel->id = 1;
                $userModel->status=10;
                $userModel->email = 'info@yiiman.ir';
                $userModel->auth_key = Yii::$app->security->generateRandomString();
                $userModel->password_hash = Yii::$app->security->generatePasswordHash('123456');
                if($userModel->save()){
                    Provider::AllSystemPermissions();
                }
            }
        }
        // </ check exist user >

        $post = Yii::$app->request->post();
        $model = new LoginForm();

        if ($model->load($post) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('email', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
