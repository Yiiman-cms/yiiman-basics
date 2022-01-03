<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\markdown;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class MarkdownEditor
 * @package YiiMan\YiiBasics\widgets\markdown
 */
class MarkdownEditor extends InputWidget
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
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->attribute, $this->value, $this->options);
        }

        $this->registerAssets();
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        MarkdownEditorAsset::register($view);
        $varName = Inflector::variablize('editor_'.$this->id);
        $script = "var {$varName} = new SimpleMDE(".$this->getEditorOptions().');';
        $view->registerJs($script);
    }

    /**
     * Return editor options in json format
     * @return string
     */
    protected function getEditorOptions()
    {
        $this->editorOptions['element'] = new JsExpression('document.getElementById("'.$this->options['id'].'")');

        return Json::encode($this->editorOptions);
    }
}
