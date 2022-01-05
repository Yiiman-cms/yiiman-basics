<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\materialTimePicker;

use yii\base\View;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class MarkdownEditor
 * @package YiiMan\YiiBasics\widgets\markdown
 */
class TimePickerWidget extends InputWidget
{
    /**
     * @var array markdown options
     */
    public $editorOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {

        $this->registerAssets();

        return $this->render(
            '@vendor/yiiman/yii-basics/src/widgets/materialTimePicker/index',
            [
                'id'       => $this->id,
                'hasModel' => $this->hasModel(),
                'cls'      => $this
            ]
        );
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        MaterialTimePickerAssets::register($view);
//        $varName = Inflector::variablize('editor_' . $this->id);
        $script = '
        var app = angular.module(\'app\', [\'ADM-dateTimePicker\']);
        console.log(app);
        app.config([\'ADMdtpProvider\', function(ADMdtp) {
		    ADMdtp.setOptions({
		        calType: \'jalali\',
		        format: \'YYYY/MM/DD\',
		        default: \'today\',
		        multiple:false,
		        autoClose:true,
		        default:"'.$this->value.'"
		    });
		}]);

        ';
        $view->registerJs($script, \yii\web\View::POS_HEAD);
    }

    /**
     * Return editor options in json format
     * @return string
     */
    protected function getEditorOptions()
    {


        $this->editorOptions['element'] = new JsExpression('document.getElementById("'.$this->id.'")');

        return Json::encode($this->editorOptions);
    }
}
