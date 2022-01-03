<?php
/**
 * Created by tokapps TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:http://tokapps.ir
 * Date: 03/22/2020
 * Time: 22:27 PM
 */

namespace YiiMan\YiiBasics\widgets\backLang;


use YiiMan\YiiBasics\lib\ActiveRecord;
use YiiMan\YiiBasics\lib\Core;
use YiiMan\YiiBasics\lib\View;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget;
use Yii;
use yii\base\Widget;
use function is_int;
use function is_string;

class backLangWidget extends Widget
{
    public function run()
    {
        if (Core::$enabledLanguage){
            return $this->render('index');
        }
    }


    public static function languages($model=null)
    {
        if (!Core::$enabledLanguage){
            return '';
        }
        $languages = Language::find()->where(['status' => Language::STATUS_ACTIVE])->all();
        if (!empty($languages)) {
            foreach ($languages as $lng) {
                self::addBtb($lng,$model);
            }
        }
    }

    public static function addBtb(Language $model,ActiveRecord $item=null)
    {
        $action = Yii::$app->controller->action->id;
        if (!empty($id)) {
            $id = 'id="' . $id . '"';
        }
        switch ($action) {
            case 'update':
            case 'create':
            case 'view':
            if (!isset($_GET['lng'])){
                $link=Yii::$app->request->url.'&lng='.$model->id;
            }else{
                $link=str_replace('&lng='.$_GET['lng'],'&lng='.$model->id,Yii::$app->request->url);
            }
                break;
            case 'index':

                if (!isset($_GET['lng'])){
                    $link=Yii::$app->request->url.'?lng='.$model->id;
                }else{
                    $link=str_replace('?lng='.$_GET['lng'],'?lng='.$model->id,Yii::$app->request->url);
                }
                break;
        }
        if (empty($link)) {
            $link = '#';
        }

        $class='';
        if (isset($item->language)){
            if ($item->language==$model->id){
                $class='btn-success';
            }
        }else{
            if (isset($_GET['lng'])){
                if ($_GET['lng']==$model->id){
                    $class='btn-success';
                }
            }
        }

        if (!empty($model->title)) {
            $tippy = TippyWidget::attribute($model->title);
        } else {
            $tippy = '';
        }

            $icon=$UploadUrl=Yii::$app->UploadManager->getImageUrl($model,'image','30*30');

        $js = <<<JS
 			$('.top-menu-container .button-container').append('<a $tippy class="item language btn $class " href="$link"> <img src="$icon"></a>');

JS;
        Yii::$app->controller->view->registerJs($js, View::POS_END);
    }
}
