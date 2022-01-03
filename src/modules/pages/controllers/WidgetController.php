<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: ۰۲/۲۴/۲۰۲۰
 * Time: ۱۲:۴۳ بعدازظهر
 */

namespace YiiMan\YiiBasics\modules\pages\controllers;


use Exception;
use YiiMan\YiiBasics\lib\Controller;
use YiiMan\YiiBasics\lib\hquery\hQuery;
use YiiMan\YiiBasics\lib\Model;
use YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\modules\widget\models\Components;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class WidgetController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex($id)
    {
        return $this->renderPartial('body', ['id' => $id]);
    }

    public function actionSample($page)
    {
        if (class_exists('\YiiMan\YiiBasics\modules\widget\controllers\DefaultController')) {
            if ($page == 'empty') {
                $pageContent = '<h1>شروع به ساخت یک برگه ی شگفت انگیز کنید</h1>';
            } else {

                $model = Pages::findOne($page);
                $pageContent = $model->content;
            }

            $controller = new \YiiMan\YiiBasics\modules\widget\controllers\DefaultController($this->id, $this->module);

            $out = $controller->actionLayout('array', $model->template,$model)['full'];
            $html = hQuery::fromHTML($out);
            $content = $html->find('begincontent')->html();
            $menu = $html->find('beginMenu')->html();
            $footer = $html->find('beginFooter')->html();
//            $out = str_replace($menu, '', $out);
//            $out = str_replace($footer, '', $out);
            $out = str_replace($content, $pageContent, $out);
            $out = str_replace('<beginfooter></beginfooter>', '', $out);
            $out = str_replace('<beginmenu></beginmenu>', '', $out);
            $out .= '<style>' . <<<CSS
main {
	margin-top: 0;
	margin-bottom: 0;
	margin-right: 0;
}
begincontent {
	display: block;
	padding-top: 200px !important;
	min-height: 500px;
	min-width: 400px;
	background: rgba(241,241,241,0.89);
	padding-left: 30px;
	padding-right: 30px;
} 


begincontent [data-url] {
	border: 5px #ff000073 solid;
	box-shadow: 5px 5px 5px #442e2e;
}
begincontent systemparameter {
	background: #071e074d;
	display: block;
	width: 100%;
	height: 100px;
	margin-top: 20px;
	margin-bottom: 20px;
	color: white;
	font-weight: 900;
	padding-top: 30px;
	font-size: 22px;
	scale: 1 !important;
}
.content-holder {
	padding: 0 !important;
}
CSS;

            $out .= '</style>';
            return $out;

        } else {

            Yii::setAlias('@page_example', Yii::$app->Options->UploadDir . '/samplePages/');
            $layout = Yii::$app->Options->UploadDir . '/samplePages/layouts/main.php';

            Yii::setAlias('@page_example_layout', Yii::$app->Options->UploadDir . '/samplePages/layouts/');
            if (!realpath($layout)) {
                throw new BadRequestHttpException(
                    'You Must Create Folder ' . Yii::$app->Options->UploadDir . '/samplePages/layouts And Create main.php Layout File For Load On Page Content Editor'
                );
            }
            $this->layout = '@frontend/views/layouts/main.php';

            return $this->render('@page_example/' . $page . '.php');
        }
    }

    public function actionSave()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['id'])) {
            try {
                if ($post['id'] == 'empty') {
                    $model = new Pages();
                    $model->title = $post['title'];

                    $node = hQuery::fromHTML($post['html']);
                    $html = $node->find('begincontent')->html();

                    $model->content =str_replace('contenteditable="true"','', ( !empty($html) ? $html : '.'));
                    if (!empty($post['default'])) {
                        Yii::$app->Options->defaultPage = $model->id;
                        $model->default = 1;
                    }
                    $model->save();

                } else {
                    $model = Pages::findOne($post['id']);
                    $node = hQuery::fromHTML($post['html']);
                    $model->title = $post['title'];


                    $model->content =str_replace('contenteditable="true"','', $node->find('begincontent')->html());

                    if (!empty($post['default'])) {
                        Yii::$app->Options->defaultPage = $model->id;
                        $model->default = 1;
                    }
                    $model->save();
                }


                // < save Slug >
                {
                    if (!empty($post['slug']) && Slug::getSlug($model) != $post['slug']) {
                        $query = <<<SQL
select * from module_slug where slug='{$post['slug']}'
SQL;

                        $SlugModel = Yii::$app->db->createCommand($query)->queryAll();
                        if (empty($SlugModel)) {
                            if ($model->isNewRecord) {
                                $SlugModel = new Slug();
                                $SlugModel->slug = $post['slug'];
                                $SlugModel->table_id = $model->id;
                                $SlugModel->table_name = $model::tableName();
                                $SlugModel->save();
                            } else {
                                $SlugModel = Slug::findOne(['table_id' => $model->id, 'table_name' => $model::tableName()]);
                                if (!empty($SlugModel)) {
                                    $SlugModel->slug = $post['slug'];
                                    $SlugModel->save();
                                } else {
                                    $SlugModel = new Slug();
                                    $SlugModel->slug = $post['slug'];
                                    $SlugModel->table_id = $model->id;
                                    $SlugModel->table_name = $model::tableName();
                                    $SlugModel->save();
                                }
                            }
                        }
                    } else {
                        if (empty($post['slug'])) {
                            $slugModel = Slug::findOne(['table_id' => $model->id, 'table_name' => $model::tableName()]);
                            if (!empty($slugModel)) {
                                $slugModel->delete();
                            }
                        }
                    }
                }
                // </ save Slug >

                $model->status = $post['status'];
                $model->template = $post['template'];

                $model->seo_description = $post['seo'];
                if (!empty($post['back'])) {
                    $model->back = $post['back'];
                }

                $model->save();
            } catch (Exception $e) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $e->getMessage();
            }
            return $model->title;
        }
    }

    private function fileTypes($extension)
    {
        $type = json_decode(file_get_contents(__DIR__ . '/mime.json'), true)[str_replace('.', '', $extension)];
        $type = explode('/', $type);
        return $type[0];
    }

    public function actionUpload($id)
    {
        if (empty($_FILES['file']['tmp_name'])) {
            return '';
        }


        // < Upload To Table >
        {


            $attribute = $_FILES['file']['name'];
            $path = Yii::$app->Options->UploadDir . '/dl/Pages';
            if (!realpath($path)) {
                @mkdir($path, 0777, true);
            }
            $fileName = uniqid();


            $fileExtension = explode('.', $attribute);
            if (empty($fileExtension)) {
                $fileExtension = '';
            } else {
                $fileExtension = '.' . $fileExtension[count($fileExtension) - 1];
            }
            $moved = move_uploaded_file($_FILES['file']['tmp_name'], $path . '/' . $fileName . $fileExtension);
            $cookie = Yii::$app->cookie->tmpFiles;
            if (empty($cookie)) {
                $tmpFile =
                    [
                        'fileName' => $fileName,
                        'fileExtension' => $fileExtension,
                        'created_at' => time(),
                        'model' => Pages::className(),
                        'attr' => $attribute,
                        'type' => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                        'size' => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                    ];
                $tmpFiles = [];
                $tmpFiles[] = $tmpFile;
                Yii::$app->cookie->tmpFiles = $tmpFiles;
            } else {

                $expired = false;
                foreach (ArrayHelper::toArray($cookie) as $ckey => $item) {
                    if ($item['model'] == Pages::className()) {
                        $lastTime = strtotime('-20 minutes');

                        if ($item['created_at'] < $lastTime) {
                            $expired = true;
                            unset($cookie[$ckey]);
                            Yii::$app->cookie->tmpFiles = $cookie;
                        }

                        if ($expired) {
                            $files = glob($path . '/*'); // get all file names
                            foreach ($files as $f) { // iterate files
                                if (is_file($f)) {
                                    if ($path . '/' . $fileName . $fileExtension == $f) {
                                        continue;
                                    }
                                    unlink($f); // delete file
                                }
                            }

                            $tmpFile =
                                [
                                    'fileName' => $fileName,
                                    'fileExtension' => $fileExtension,
                                    'created_at' => time(),
                                    'model' => Pages::className(),
                                    'attr' => $attribute,
                                    'type' => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                    'size' => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                                ];
                            $tmpFiles = [];
                            $tmpFiles[] = $tmpFile;
                            Yii::$app->cookie->tmpFiles = $tmpFiles;
                        } else {
                            $tmpFile =
                                [
                                    'fileName' => $fileName,
                                    'fileExtension' => $fileExtension,
                                    'created_at' => time(),
                                    'model' => Pages::className(),
                                    'attr' => $attribute,
                                    'type' => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                    'size' => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                                ];

                            $cookie[] = $tmpFile;
                            Yii::$app->cookie->tmpFiles = $cookie;
                        }
                    } else {
                        $tmpFile =
                            [
                                'fileName' => $fileName,
                                'fileExtension' => $fileExtension,
                                'created_at' => time(),
                                'model' => Pages::className(),
                                'attr' => $attribute,
                                'type' => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                'size' => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                            ];
                        $tmpFiles = [];
                        $tmpFiles[] = $tmpFile;
                        Yii::$app->cookie->tmpFiles = ArrayHelper::merge(ArrayHelper::toArray($cookie), $tmpFiles);
                    }
                }
            }


        }
        // </ Upload To Table >


        echo Yii::$app->Options->URL . Yii::$app->Options->UploadUrl . '/dl/Pages/' . $fileName . $fileExtension;
    }
}
