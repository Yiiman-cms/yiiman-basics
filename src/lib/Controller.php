<?php
/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 *
 * Site:https://yiiman.ir
 * Date: 12/29/2018
 * Time: 1:05 PM
 */

namespace YiiMan\YiiBasics\lib;


use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\modules\blog\models\BlogArticleFkCategory;
use YiiMan\YiiBasics\modules\blog\models\BlogArticles;
use YiiMan\YiiBasics\modules\blog\models\BlogCategory;
use YiiMan\YiiBasics\modules\blog\models\BlogComment;
use YiiMan\YiiBasics\modules\bots\models\Bots;
use YiiMan\YiiBasics\modules\form\models\FormInbox;
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\menu\models\Menu;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\search\models\Search;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\modules\works\models\Works;
use YiiMan\YiiBasics\widgets\nestedItems\NestedItems;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\View;
use yii\base\Widget;
use yii\db\Migration;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use function count;
use function explode;
use function str_replace;
use function strtolower;
use function substr;

/**
 * Class Controller
 * @property ActiveRecord $modelClass
 * @property ActiveRecord $model
 * @package YiiMan\YiiBasics\lib
 */
class Controller extends \yii\web\Controller
{
    public $model;
    public $modelClass;
    public $hasLanguage = true;
    /**
     * @var View the view object that can be used to render views or view files.
     */
    private $_view;
    public $SluggedParams;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        if (Yii::$app->id == 'app-backend') {
            $methods = get_class_methods($this::className());
            $access = [];
            foreach ($methods as $method) {
                $action = str_replace('action', '', $method);
                preg_match_all('/((?:^|[A-Z])[a-z]+)/', $action, $matches);
                if (!empty($matches[0])) {
                    $a = '';
                    foreach ($matches[0] as $k => $m) {
                        $a .= lcfirst($m);
                        if (!empty($matches[0][$k + 1])) {
                            $a .= '-';
                        }
                    }
                }
                $access[] = $a;
            }

            return [
                'access' =>
                    [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'actions' => $access,
                                'allow' => true,
                                'roles' => ['@'],
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

        } else {
            return [];
        }
    }

    public function actionSearch($q)
    {
        $this->layout = 'main2';
        $html = '';
        $itemCount = 0;
        if (!empty(Search::getConfigs())) {
            foreach (Search::getConfigs()['types'] as $options) {
                // < Search Item >
                {
                    /**
                     * @var ActiveRecord $options .model
                     */
                    $model = $options['model']::find()
                        ->andFilterWhere(['like', $options['search_field'], $q])
                        ->all();
                    $itemCount = $itemCount + count($model);

                    // < widget >
                    {
                        $options['widget']['template'] =
                            [
                                'head' => '{items}',
                                'item_head' => '{item}',
                                'item_body' => file_get_contents(Yii::getAlias('@system/theme/components/' . $options['widget']['template'] . '/index.html'))
                            ];
                    }
                    // </ widget >

                    $html .=
                        NestedItems::widget(
                            ArrayHelper::merge(['dataModel' => $model], $options['widget'])
                        );

                }
                // </ Search Item >
            }


            // < save Stat >
            {
                try {
                    $details = json_decode(file_get_contents("https://api.ipdata.co/" . Yii::$app->functions->getClientIP() . "?api-key=test"));
                } catch (\Exception $e) {
                }

                $smodel = new Search();
                $smodel->query = $q;
                $smodel->created_at = date('Y-m-d');
                $smodel->resultCount = $itemCount;
                $smodel->isbot = Yii::$app->DeviceDetector->isBot();
                $smodel->ip = Yii::$app->functions->getClientIP();
                $smodel->device = Yii::$app->DeviceDetector->getDeviceName();
                $smodel->browser = Yii::$app->DeviceDetector->getClient('short_name');
                if (!empty($details)) {
                    $smodel->lat = (float)$details->latitude;
                    $smodel->lng = (float)$details->longitude;
                    $smodel->flag = $details->flag;
                    $smodel->city = $details->city;
                    $smodel->country = $details->country;
                }
                $smodel->save();
            }
            // </ save Stat >

            if (empty($itemCount)) {
                $html = \Yii::t('site', 'متاسفانه نتیجه ای یافت نشد');
            }
            return $this->renderTemplate(Search::getConfigs()['view'], ['html' => $html]);
        }
    }

    public function beforeAction($actionorg)
    {

        $module = $this->module->basePath;
        if (strpos($module, '/') !== false) {
            $module = explode('/', $module);
        } else {
            $module = explode(
                '\\',
                $module
            );
        }
        $module = $module[count($module) - 1];

        $controller = $this::className();
        $controller = explode('\\', $controller);
        $controller = $controller[count($controller) - 1];
        $controller = str_replace('Controller', '', $controller);
        if (!empty($this->action->actionMethod)) {
            $action = strtolower(substr($this->action->actionMethod, 6));
        }

        if (!empty($action) && Yii::$app->user->Can($module . '_' . $controller . '_' . $action)) {
            throw new ForbiddenHttpException(Yii::t('rbac', 'You do not have access to this page'));
        }

        return parent::beforeAction($actionorg); // TODO: Change the autogenerated stub
    }

    public function afterAction($action, $result)
    {
        try{

            if (class_exists('YiiMan\YiiBasics\modules\hint\models\Hint')) {
                $hint = Hint::getConfig($this::className());
                if (!empty($hint)) {
                    if (!empty($hint[$this->action->id])) {
                        if (!empty($this->SluggedParams)) {
                            Hint::hint($hint[$this->action->id], (int)$this->SluggedParams);
                        }
                    }
                }
            }
            \YiiMan\YiiBasics\lib\i18n\I18N::saveCache();
        }catch (\Exception $e){}
        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }

    public function actions()
    {

        return [
            'error' => [
                'class' => 'YiiMan\YiiBasics\modules\error\actions\ErrorHandler',
            ],
        ];
    }


    public function actionArticle($id)
    {
        $post = Yii::$app->request->post();
        if (!empty($post)) {
            return BlogComment::addNewComment
            (
                $post['message'],
                $id,
                $post['email'],
                (int)$post['reply'],
                $post['name']
            );

        }

        if (!($html = Yii::$app->Cachee->getCache('Article' . $id)) || !empty($post)) {
            $this->layout = 'main2';
            $model = BlogArticles::findOne($id);
            if (empty($model)) {
                throw new NotFoundHttpException(\Yii::t('blog', 'متاسفانه مقاله ی مورد نظر یافت نشد'));
            }
            return Yii::$app->Cachee->addCache('Article' . $id,
                $this->renderTemplate('article', ['model' => $model])
            );
        }


        return $html;
    }


    public function actionArticles()
    {
        if (!($html = Yii::$app->Cachee->getCache('Articles')) || !empty($post)) {
            $this->layout = 'main2';
            $model = BlogArticles::find()->where(['status' => 1])->all();
            $options = BlogCategory::getConfigs();
            $html = '';
            // < widget >
            {
                $options['template'] =
                    [
                        'head' => '{items}',
                        'item_head' => '{item}',
                        'item_body' => file_get_contents(Yii::getAlias('@system/theme/components/articleCardClassic/index.html'))
                    ];
            }
            // </ widget >

            $html .=
                NestedItems::widget(
                    ArrayHelper::merge(['dataModel' => $model], $options)
                );
            if (empty($html)) {
                $html = \Yii::t('site', 'متاسفانه هنوز اطلاعاتی در این دسته ثبت نشده است');
            }

            return Yii::$app->Cachee->addCache('Articles',
                $this->renderTemplate('articles', ['articles' => $html])
            );
        }


        return $html;
    }

    public function actionFroalaUpload()
    {
        $file = $_FILES;
        Yii::$app->response->format = Response::FORMAT_JSON;
        @mkdir(Yii::$app->Options->UploadDir . '/dl/froala/', 0777, true);
        $fileLocation = Yii::$app->Options->UploadDir . '/dl/froala/' . $file['file']['name'];
        $copy = copy($file['file']['tmp_name'], $fileLocation);
        return
            [
                'link' => Yii::$app->Options->UploadUrl . '/dl/froala/' . $file['file']['name'],
                'copy' => $copy,
//                'loc' => $fileLocation,
                'file-0' =>
                    [
                        'url' => Yii::$app->Options->UploadUrl . '/dl/froala/' . $file['file']['name'],
                        'id' => uniqid()
                    ]
            ];


    }

    public function actionRedactorUpload()
    {
        $file = $_FILES;
        Yii::$app->response->format = Response::FORMAT_JSON;
        @mkdir(Yii::$app->Options->UploadDir . '/dl/redactor/', 0777, true);
        $fileLocation = Yii::$app->Options->UploadDir . '/dl/redactor/' . $file['file']['name'];
        $copy = copy($file['file']['tmp_name'], $fileLocation);
        return
            [
                'filelink' => Yii::$app->Options->UploadUrl . '/dl/redactor/' . $file['file']['name'],
                'filename' => $file['file']['name']
            ];


    }


    public function actionCategory($id)
    {
        $this->layout = 'main2';
        $html = '';
        $options = BlogCategory::getConfigs();
        $cat = BlogCategory::findOne($id);

        $articles = $cat->relationCustomFKMany(
            [BlogArticleFkCategory::className() => BlogArticles::className()],
            ['category' => 'article']
        );

        // < widget >
        {
            $options['template'] =
                [
                    'head' => '{items}',
                    'item_head' => '{item}',
                    'item_body' => file_get_contents(Yii::getAlias('@system/theme/components/' . $options['template'] . '/index.html'))
                ];
        }
        // </ widget >


        $html .=
            NestedItems::widget(
                ArrayHelper::merge(['dataModel' => $articles], $options)
            );
        if (empty($html)) {
            $html = \Yii::t('site', 'متاسفانه هنوز اطلاعاتی در این دسته ثبت نشده است');
        }
        return $this->renderTemplate('category', ['articles' => $html, 'cat' => $cat]);
    }

    /**
     * صفحه ی اصلی سایت را با زبان اشاره شده در URL باز میکند
     * @param $lang
     * @return mixed
     */
    public function actionLang($lang)
    {

        if (!empty(Yii::$app->Language->getLanguages()[strtoupper($lang)])) {
            Yii::$app->language = Language::changeLanguage(strtoupper($lang));
            return eval('return  $this->action' . ucfirst($this->defaultAction) . '();');
        }

    }


    /**
     * اکشن فراخوانی شده را به زبان اشاره شده در URL بازگردانی میکند
     * @param $lang
     * @param $action
     * @param null $parameter
     * @return mixed
     */
    public function actionLangaction($lang, $action, $parameter = null)
    {
        if (!empty(Yii::$app->Language->getLanguages()[strtoupper($lang)])) {
            Yii::$app->language = Language::changeLanguage(strtoupper($lang));

            return eval('return  $this->action' . ucfirst($action) . '(' . $parameter . ');');
        }
    }


    public function renderTemplate($view, $params = [])
    {
        $content = $this->getView()->render($view, $params, $this);
        $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, ArrayHelper::merge($params, ['content' => $content, 'isTemplate' => true]), $this);
        }

        return parent::render($view, $params); // TODO: Change the autogenerated stub
    }

    public function actionMenu($id)
    {
        $model = Menu::findOne($id);
        if (!empty($model)) {
            $type = $model::getType($model->type);
            return $this->{'action' . ucfirst($type['action'])}($model->related_id);
        } else {
            throw new NotFoundHttpException('This Page Is Not Exist');
        }
    }


    public function actionPage($id)
    {

        $model = Pages::findOne($id);
        if (!empty($model)) {
            $this->layout = $model->template;
            return $this->renderTemplate('page', ['model' => $model, 'tags' => $model->gettags()]);

        } else {
            throw new NotFoundHttpException(\Yii::t('site', 'این صفحه وجود ندارد'));
        }
    }

    public function actionFormSave()
    {
        $content = $_POST;
        if (!empty($content)) {

            $form = new FormInbox();
            $form->ip = Yii::$app->functions->getClientIP();
            $form->created_at = date('Y-m-d H:i:s');
            $form->status = $form::STATUS_NOT_SEEN;
            $form->form = (int)$_POST['formId'];


            // < Check Files >
            {
                if (!empty($_FILES)) {
                    foreach ($_FILES as $field => $file) {
                        @mkdir(Yii::$app->Options->UploadDir . '/dl/form/', 0777, true);
                        copy($file['tmp_name'], Yii::$app->Options->UploadDir . '/dl/form/' . $file['name']);
                        $content[$field] = $file['name'];
                    }
                }
            }
            // </ Check Files >

            $form->details = json_encode($content);
            if ($form->save()) {
                Yii::$app->session->addFlash('success', \Yii::t('form', 'اطلاعات شما با موفقیت ارسال شد'));
            } else {
                if (!empty($form->errors)) {

                    Yii::$app->session->addFlash('warning', $form->getErrorSummary(true)[0]);
                }
            }
        }


        return $this->goBack();
    }

    /**
     * این اکشن اسلاگ ها را بررسی میکند و چنانچه اسلاگ برای یکی از مدل ها یافت شود، اکشن آن را اجرا میکند
     * @param $slug
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionSlug($slug)
    {
        $model = Slug::loadSlug($slug);

        if (!empty($model)) {
            $slug = $model::getAllSlugs()[$model->table_name];

            $params = '';
            foreach ($slug['params'] as $key => $param) {
                if ($param == 'id') {
                    $this->SluggedParams = $model->table_id;
                }
                $p = str_replace('id', '$model->table_id', $param);
                $params .= $p;
                if (isset($slug['params'][$key + 1])) {
                    $params .= ',';
                }
            }
            $this->action->id = $slug['action'];

            $function = 'return $this->action' . ucfirst($slug['action']) . '(' . $params . ');';

            return eval($function);
        } else {
            throw new NotFoundHttpException('This Page Is Not Exist');
        }
    }


    /**
     * Finds the Skills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $lng
     * @param integer $id
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $lng = null)
    {
        if (empty($lng) && !empty($_GET['lng'])) {
            $lng = $_GET['lng'];
        }
        // < check language >
        {
            if (empty($this->modelClass)) {
                throw new BadRequestHttpException('modelClass را در کنترلر پر کنید');
            }

            if (!empty($this->modelClass)) {
                $mclass = new $this->modelClass();
                if (!$mclass->hasAttribute('language')) {
                    if ($this->hasLanguage) {
                        $mig = new Migration();

                        $mig->addColumn($mclass::tableName(), 'language', $mig->integer());
                        $mig->addColumn($mclass::tableName(), 'language_parent', $mig->integer());
                        unset($mig);
                    }
                    unset($mclass);
                }
            }
        }
        // </ check language >

        if (empty($lng)) {
            // < زبانی برای جست و جو به مدل داده نشده است >
            {
                if (($this->model = $this->modelClass::findOne($id)) !== null) {
                    return $this->model;
                }
            }
            // </ زبانی برای جست و جو به مدل داده نشده است >
        } else {
            // < آی دی یک زبان اعلام شده >
            {
                $this->model = $this->modelClass::find()->where(['id' => $id, 'language' => $lng])->one();
                if (empty($this->model)) {
                    // < آی دی ارائه شده زبان درخواست شده را در بانک داده ندارد >
                    {
                        $this->model = $this->modelClass::find()->where(['language_parent' => $id, 'language' => $lng])->one();
                    }
                    // </ آی دی ارائه شده زبان درخواست شده را در بانک داده ندارد >
                }
                if (empty($this->model)) {
                    // < زبان و آی دی مورد نظر هنوز پیدا نشده است >
                    {
                        $baseModel = $this->modelClass::find()->where(['id' => $id, 'language_parent' => null])->one();
                        if (empty($baseModel)) {
                            $baseModel = $this->modelClass::find()->where(['id' => $id])->one();
                            if (!empty($baseModel)) {
                                if (!empty($baseModel->language_parent)) {
                                    $redirectUrl = str_replace(
                                        [
                                            '?id=' . $_GET['id'],
                                            '&id=' . $_GET['id'],
                                        ],
                                        [
                                            '?id=' . $baseModel->language_parent,
                                            '&id=' . $baseModel->language_parent,
                                        ], Yii::$app->request->url);
                                    header('Location: ' . $redirectUrl);
                                    exit();
                                }
                            }
                        }
                        if (empty($baseModel)) {
                            throw new NotFoundHttpException(Yii::t('skills', 'The requested page does not exist.'));
                        } else {
                            $newModel = new $this->modelClass();
                            foreach ($newModel->attributes as $attribute => $val) {
                                if ($attribute == 'language') {
                                    $newModel->language = $lng;
                                    continue;
                                }
                                if ($attribute == 'language_parent') {
                                    $newModel->$attribute = $id;
                                    continue;
                                }
                                if ($attribute == 'id') {
                                    continue;
                                }

                                $newModel->$attribute = $baseModel->$attribute;
                            }
                            $newModel->save();
                            return $newModel;
                        }
                    }
                    // </ زبان و آی دی مورد نظر هنوز پیدا نشده است >
                } else {
                    return $this->model;
                }
            }
            // </ آی دی یک زبان اعلام شده >

        }
    }

    /**
     * Returns the view object that can be used to render views or view files.
     * The [[render()]], [[renderPartial()]] and [[renderFile()]] methods will use
     * this view object to implement the actual view rendering.
     * If not set, it will default to the "view" application component.
     * @return View|\yii\web\View the view object that can be used to render views or view files.
     */
    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = Yii::$app->getView();
        }

        return $this->_view;
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
