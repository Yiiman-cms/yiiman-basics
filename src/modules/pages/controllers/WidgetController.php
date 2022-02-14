<?php
/**
 * Copyright (c) 2022-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
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

            $out = $controller->actionLayout('array', $model->template, $model)['full'];
            $html = hQuery::fromHTML($out);
            $content = $html->find('begincontent')->html();
//            $menu = $html->find('beginMenu')->html();
//            $footer = $html->find('beginFooter')->html();
//            $out = str_replace($menu, '', $out);
//            $out = str_replace($footer, '', $out);
            $out = str_replace($content, $pageContent, $out);
            $out = str_replace('<beginfooter></beginfooter>', '', $out);
            $out = str_replace('<beginmenu></beginmenu>', '', $out);
            $out = str_replace('<beginheader></beginheader>', '', $out);
            $out .= '<style id="styleHelpers">'.<<<CSS
 beginfooter,beginHeader {
        filter: blur(3px);
    }
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


body, textarea {
	background: rgb(255, 255, 255) !important;
}
main {
	margin-top: 130px;
	margin-bottom: 50px;
	margin-right: 50px;
}
.content-holder {
	padding: 0 !important;
}
begincontent img{
    min-height: 150px;
    min-width: 150px;
}
begincontent .content {
	border-left: 30px #28728e2e solid;
	content: "بلوک(.content)";
	margin-bottom: 30px;
	margin-top: 30px;
	
}
begincontent .row::before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "(Row)ردیف";
	font-size: 12px;
	font-weight: bold;
	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent .container::before, begincontent .container-fluid::before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "CONTAINER";
	font-size: 12px;
	font-weight: bold;
	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent p::before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "پاراگراف(p)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent ul::before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "(UL)قاب لیست";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent li::before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "آیتم لیست(LI)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h1::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "تیتر۱(H1)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h2::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "تیتر۲(H2)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h3::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "تیتر۳(H3)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h4::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "تیتر۴(H4)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h5::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "تیتر۵(H5)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent h6::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "(H6)تیتر۶";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent div::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "عمق(Div)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent svg::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "SVG";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent i::before
 {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "آیکون(I)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent section::before
 {
	background-color: #0c3855;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "بخش(Section)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent a::before
 {
	background-color: #0c553b;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "لینک(a)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent figure::before
 {
	background-color: #0c553b;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "فیگور(figure)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent article::before
 {
	background-color: #19557a;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "محتوا(Article)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent audio::before
 {
	background-color: #19557a;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "صوت(Audio)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent button::before
 {
	background-color: #19557a;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "کلید(Button)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent canvas::before
 {
	background-color: #19557a;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "کلید(Canvas)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent code::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "کد(Code)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent footer::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "فوتر(Footer)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent form::before
{
	background-color: #dc6c27;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #ffffff;
	content: "فرم(Form)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent label::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "برچسب(Label)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent input::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "ورودی(Input)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent select::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "جعبه انتخاب(Selector)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent span::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "رنگ(Span)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent table::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "جدول(Table)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent tr::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "ردیف جدول(Tr)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent td::before,begincontent th::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "ستون جدول(Td)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}
begincontent video::before
{
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "ویدیو(Video)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;
	top: 0;
	display: block;
	width: 100%;
}

begincontent .content::before {
	
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "بلوک(.content)";
	font-size: 12px;
	font-weight: bold;

	line-height: 2;
	padding: 3px 7px;
	position: relative;

	rotate: -90deg;
	background: transparent;
	border: none;
		top: 0;
	display: block;
	width: 100%;
}
begincontent .col::before,
begincontent  .col-1::before,
begincontent .col-10::before,
begincontent .col-11::before,
begincontent .col-12::before,
begincontent .col-2::before,
begincontent .col-3::before,
begincontent .col-4::before,
begincontent .col-5::before,
begincontent .col-6::before,
begincontent .col-7::before,
begincontent .col-8::before,
begincontent .col-9::before,
begincontent .col-auto::before,
begincontent .col-lg::before,
begincontent .col-lg-1::before,
begincontent .col-lg-10::before,
begincontent .col-lg-11::before,
begincontent .col-lg-12::before,
begincontent .col-lg-2::before,
begincontent .col-lg-3::before,
begincontent .col-lg-4::before,
begincontent .col-lg-5::before,
begincontent .col-lg-6::before,
begincontent .col-lg-7::before,
begincontent .col-lg-8::before,
begincontent .col-lg-9::before,
begincontent .col-lg-auto::before,
begincontent .col-md::before,
begincontent .col-md-1::before,
begincontent .col-md-10::before,
begincontent .col-md-11::before,
begincontent .col-md-12::before,
begincontent .col-md-2::before,
begincontent .col-md-3::before,
begincontent .col-md-4::before,
begincontent .col-md-5::before,
begincontent .col-md-6::before,
begincontent .col-md-7::before,
begincontent .col-md-8::before,
begincontent .col-md-9::before,
begincontent .col-md-auto::before,
begincontent .col-sm::before,
begincontent .col-sm-1::before,
begincontent .col-sm-10::before,
begincontent .col-sm-11::before,
begincontent .col-sm-12::before,
begincontent .col-sm-2::before,
begincontent .col-sm-3::before,
begincontent .col-sm-4::before,
begincontent .col-sm-5::before,
begincontent .col-sm-6::before,
begincontent .col-sm-7::before,
begincontent .col-sm-8::before, 
begincontent .col-sm-9::before,
begincontent .col-sm-auto::before,
begincontent .col-xl::before,
begincontent .col-xl-1::before,
begincontent .col-xl-10::before,
begincontent .col-xl-11::before,
begincontent .col-xl-12::before,
begincontent .col-xl-2::before,
begincontent .col-xl-3::before,
begincontent .col-xl-4::before,
begincontent .col-xl-5::before,
begincontent .col-xl-6::before,
begincontent .col-xl-7::before,
begincontent .col-xl-8::before,
begincontent .col-xl-9::before,
begincontent .col-xl-auto::before
{
background-color: #F5F5F5;
border: 1px solid #DDD;
border-radius: 4px 0 4px 0;
color: #9DA0A4;
content: "(Column)ستون ریسپانسیو";
font-size: 12px;
font-weight: bold;
left: 0;
padding: 3px 7px;
position: relative;
top: -1px;
width: 100%;
display: block;
}
CSS;

            $out .= '</style>';
            return $out;

        } else {

            Yii::setAlias('@page_example', Yii::$app->Options->UploadDir.'/samplePages/');
            $layout = Yii::$app->Options->UploadDir.'/samplePages/layouts/main.php';

            Yii::setAlias('@page_example_layout', Yii::$app->Options->UploadDir.'/samplePages/layouts/');
            if (!realpath($layout)) {
                throw new BadRequestHttpException(
                    'You Must Create Folder '.Yii::$app->Options->UploadDir.'/samplePages/layouts And Create main.php Layout File For Load On Page Content Editor'
                );
            }
            $this->layout = '@frontend/views/layouts/main.php';

            return $this->render('@page_example/'.$page.'.php');
        }
    }

    public function actionSave()
    {
        $post = $_POST;
        if (!empty($post['html'])) {
            $post['html']=html_entity_decode($post['html']);
        }
        if (!empty($post['id'])) {
            try {
                if ($post['id'] == 'empty') {
                    $model = new Pages();
                    $model->title = $post['title'];

                    $node = hQuery::fromHTML($post['html']);
                    $html = $node->find('begincontent')->html();

//                    $model->content = str_replace('contenteditable="true"', '', (!empty($html) ? $html : '.'));
                    $model->content =  $post['html'];
                    if (!empty($post['default'])) {
                        Yii::$app->Options->defaultPage = $model->id;
                        $model->default = 1;
                    }
                    $model->save();

                } else {
                    $model = Pages::findOne($post['id']);
//                    $node = hQuery::fromHTML($post['html']);
                    $model->title = $post['title'];


                    $model->content = $post['html'];
                    if (!empty($post['default'])) {
                        Yii::$app->Options->defaultPage = $model->id;


                        // < Find old defaults >
                        {
                            $defaultPage=Pages::find()->where(['default'=>1,'language'=>Yii::$app->Language->currentID()])->all();
                            if (!empty($defaultPage)) {
                                foreach ($defaultPage as $p){
                                    $p->default=null;
                                    $p->save();
                                }
                            }
                        }
                        // </ Find old defaults >


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
                                $SlugModel = Slug::findOne(['table_id'   => $model->id,
                                                            'table_name' => $model::tableName()
                                ]);
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
                            $slugModel = Slug::findOne(['table_id'   => $model->id,
                                                        'table_name' => $model::tableName()
                            ]);
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

    public function actionUpload($id)
    {
        if (empty($_FILES['file']['tmp_name'])) {
            return '';
        }


        // < Upload To Table >
        {


            $attribute = $_FILES['file']['name'];
            $path = Yii::$app->Options->UploadDir.'/dl/Pages';
            if (!realpath($path)) {
                @mkdir($path, 0777, true);
            }
            $fileName = uniqid();


            $fileExtension = explode('.', $attribute);
            if (empty($fileExtension)) {
                $fileExtension = '';
            } else {
                $fileExtension = '.'.$fileExtension[count($fileExtension) - 1];
            }
            $moved = move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'.$fileName.$fileExtension);
            $cookie = Yii::$app->cookie->tmpFiles;
            if (empty($cookie)) {
                $tmpFile =
                    [
                        'fileName'      => $fileName,
                        'fileExtension' => $fileExtension,
                        'created_at'    => time(),
                        'model'         => Pages::className(),
                        'attr'          => $attribute,
                        'type'          => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                        'size'          => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
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
                            $files = glob($path.'/*'); // get all file names
                            foreach ($files as $f) { // iterate files
                                if (is_file($f)) {
                                    if ($path.'/'.$fileName.$fileExtension == $f) {
                                        continue;
                                    }
                                    unlink($f); // delete file
                                }
                            }

                            $tmpFile =
                                [
                                    'fileName'      => $fileName,
                                    'fileExtension' => $fileExtension,
                                    'created_at'    => time(),
                                    'model'         => Pages::className(),
                                    'attr'          => $attribute,
                                    'type'          => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                    'size'          => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                                ];
                            $tmpFiles = [];
                            $tmpFiles[] = $tmpFile;
                            Yii::$app->cookie->tmpFiles = $tmpFiles;
                        } else {
                            $tmpFile =
                                [
                                    'fileName'      => $fileName,
                                    'fileExtension' => $fileExtension,
                                    'created_at'    => time(),
                                    'model'         => Pages::className(),
                                    'attr'          => $attribute,
                                    'type'          => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                    'size'          => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                                ];

                            $cookie[] = $tmpFile;
                            Yii::$app->cookie->tmpFiles = $cookie;
                        }
                    } else {
                        $tmpFile =
                            [
                                'fileName'      => $fileName,
                                'fileExtension' => $fileExtension,
                                'created_at'    => time(),
                                'model'         => Pages::className(),
                                'attr'          => $attribute,
                                'type'          => is_array($_FILES['file']['type']) ? $_FILES['file']['type'][0] : $_FILES['file']['type'],
                                'size'          => is_array($_FILES['file']['size']) ? $_FILES['file']['size'][0] : $_FILES['file']['size'],
                            ];
                        $tmpFiles = [];
                        $tmpFiles[] = $tmpFile;
                        Yii::$app->cookie->tmpFiles = ArrayHelper::merge(ArrayHelper::toArray($cookie), $tmpFiles);
                    }
                }
            }


        }
        // </ Upload To Table >


        echo Yii::$app->Options->UploadUrl.'/dl/Pages/'.$fileName.$fileExtension;
    }

    private function fileTypes($extension)
    {
        $type = json_decode(file_get_contents(__DIR__.'/mime.json'), true)[str_replace('.', '', $extension)];
        $type = explode('/', $type);
        return $type[0];
    }
}
