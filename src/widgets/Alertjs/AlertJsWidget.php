<?php


namespace YiiMan\YiiBasics\widgets\Alertjs;


use phpDocumentor\Reflection\Types\This;

use yii\bootstrap\Widget;

class AlertJsWidget extends Widget
{
    const THEME_BOOTSTRAP = 'bootstrap';
    const THEME_DEFAULT = 'default';
    const THEME_SEMANTIC = 'semantic';

    const TYPE_NORMAL = 'message';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';


    public static $loaded = false;

    public $theme = 'bootstrap';
    public $text = '';
    public $type = 'message';

    private function registerAssets()
    {
        if (!self::$loaded) {

            AlertJsAssets::$theme = $this->theme;
            AlertJsAssets::register($this->view);
        } else {
            self::$loaded = true;
        }
    }

    public function run()
    {
        if (empty($this->text)) {
            if (empty($flashes = \Yii::$app->session->allFlashes)) {
                return '';
            } else {
                $this->registerAssets();
            }
        } else {
            $this->registerAssets();
        }
        $js = '';
        if (empty($this->text)) {
            foreach ($flashes as $attr => $flash) {
                if (
                    ($attr == 'warning') |
                    ($attr == 'success') |
                    ($attr == 'info') |
                    ($attr == 'danger')
                ) {
                    $attr = str_replace(['info', 'danger'], ['message', 'error'], $attr);
                    $js .= <<<JS
alertify.{$attr}('{$flash[0]}');
JS;
                }
            }
        } else {

            $js = <<<JS
alertify.{$this->type}('{$this->text}');
JS;
        }

        $this->view->registerJs($js, $this->view::POS_END);

    }
}
