<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\floara;

use YiiMan\YiiBasics\lib\i18n\Layout;
use YiiMan\YiiBasics\lib\View;
use yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class FroalaEditorWidget extends InputWidget
{
    const PLUGIN_NAME = 'FroalaEditor';

    /**
     * @var array
     * Plugins to be included, leave empty to load all plugins
     * <pre>sample input:
     * [
     *      //specify only needed forala plugins (local files)
     *      'url',
     *      'align',
     *      'char_counter',
     *       ...
     *      //override default files for a specific plugin
     *      'table' => [
     *              'css' => '<new css file url>'
     *          ],
     *      //include custom plugin
     *      'my_plugin' => [
     *              'js' => '<js file url>' // required
     *              'css' => '<css file url>' // optional
     *          ],
     *      ...
     * ]
     */
    public $clientPlugins;

    /**
     * Remove these plugins from this list plugins, this option overrides 'clientPlugins'
     * @var array
     */
    public $excludedPlugins;

    /**
     * FroalaEditor Options
     * @var array
     */
    public $clientOptions = [];

    /**
     * csrf cookie param
     * @var string
     */
    public $csrfCookieParam = '_csrfCookie';

    /**
     * @var boolean
     */
    public $render = true;

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->render) {
            if ($this->hasModel()) {
                echo Html::activeTextarea($this->model, $this->attribute, $this->options);
                echo Html::button('بازنشانی ویرایشگر',
                    ['class' => 'btn btn-success reset-froala'.$this->options['id']]);
            } else {
                echo Html::textarea($this->name, $this->value, $this->options);
                echo Html::button('بازنشانی ویرایشگر',
                    ['class' => 'btn btn-success reset-froala'.$this->options['id']]);
            }
        }
        $this->registerClientScript();
    }

    /**
     * register client scripts(css, javascript)
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $asset = FroalaEditorAsset::register($view);
        $asset->registerClientPlugins($this->clientPlugins, $this->excludedPlugins);
//
        //theme
        $themeType = isset($this->clientOptions['theme']) ? $this->clientOptions['theme'] : 'default';
        if ($themeType != 'default') {
            $view->registerCssFile("{$asset->baseUrl}/css/themes/{$themeType}.css",
                ['depends' => '\YiiMan\YiiBasics\widgets\floara\FroalaEditorAsset']);
        }

        //language
        $langType = isset($this->clientOptions['language']) ? $this->clientOptions['language'] : 'en_gb';
        if ($langType != 'es_gb') {
            $view->registerJsFile("{$asset->baseUrl}/js/languages/{$langType}.js",
                ['depends' => '\YiiMan\YiiBasics\widgets\floara\FroalaEditorAsset']);
        }

        $id = $this->options['id'];
        if (empty($this->clientPlugins)) {
            $pluginsEnabled = false;
        } else {
            $pluginsEnabled = array_diff($this->clientPlugins, $this->excludedPlugins ?: []);
        }
        if (!empty($pluginsEnabled)) {
            foreach ($pluginsEnabled as $key => $item) {
                $pluginsEnabled[$key] = lcfirst(yii\helpers\Inflector::camelize($item));
            }
        }

        $jsOptions = array_merge($this->clientOptions, $pluginsEnabled ? ['pluginsEnabled' => $pluginsEnabled] : []);
        $jsOptions['direction'] = Layout::run();
        $jsOptions['documentReady'] = true;
//        $jsOptions['editInPopup']=true;
        $jsOptions['htmlAllowComments'] = true;
        $jsOptions['htmlExecuteScripts'] = true;
        $jsOptions['pasteAllowLocalImages'] = true;
        $jsOptions['toolbarInline'] = false;
        $jsOptions['theme'] = 'dark';
        $jsOptions['htmlRemoveTags'] = [];
        $jsOptions['htmlAllowedTags'] =
            [
                'systemparameter',
                'a',
                'abbr',
                'address',
                'area',
                'article',
                'aside',
                'audio',
                'b',
                'base',
                'bdi',
                'bdo',
                'blockquote',
                'br',
                'button',
                'canvas',
                'caption',
                'cite',
                'code',
                'col',
                'colgroup',
                'datalist',
                'dd',
                'del',
                'details',
                'dfn',
                'dialog',
                'div',
                'dl',
                'dt',
                'em',
                'embed',
                'fieldset',
                'figcaption',
                'figure',
                'footer',
                'form',
                'h1',
                'h2',
                'h3',
                'h4',
                'h5',
                'h6',
                'header',
                'hgroup',
                'hr',
                'i',
                'iframe',
                'img',
                'input',
                'ins',
                'kbd',
                'keygen',
                'label',
                'legend',
                'li',
                'link',
                'main',
                'map',
                'mark',
                'menu',
                'menuitem',
                'meter',
                'nav',
                'noscript',
                'object',
                'ol',
                'optgroup',
                'option',
                'output',
                'p',
                'param',
                'pre',
                'progress',
                'queue',
                'rp',
                'rt',
                'ruby',
                's',
                'samp',
                'script',
                'style',
                'section',
                'select',
                'small',
                'source',
                'span',
                'strike',
                'strong',
                'sub',
                'summary',
                'sup',
                'table',
                'tbody',
                'td',
                'textarea',
                'tfoot',
                'th',
                'thead',
                'time',
                'title',
                'tr',
                'track',
                'u',
                'ul',
                'var',
                'video',
                'wbr'
            ];
        $jsOptions['htmlAllowedEmptyTags'] = [
            'systemparameter',
            'textarea',
            'a',
            'iframe',
            'object',
            'video',
            'style',
            'script',
            '.fa',
            '.fr-emoticon',
            '.fr-inner',
            'path',
            'line',
            'hr'
        ];
        $jsOptions = Json::encode($jsOptions);
        $view->registerJs("\$('#$id').froalaEditor($jsOptions);");

        $class = '.reset-froala'.$this->options['id'];
        $js = <<<JS
		$('$class').click(function() {
		
		frotokapps(jQuery);
		setTimeout(function() {
		 $('#$id').froalaEditor($jsOptions);
		},1000);
		
		});

window.onbeforeunload = function(){
            return 'آیا از ترک این صفحه اطمینان دارید؟همه ی تغییرات از بین می رود';
        };
JS;
        $view->registerCss('*{transition:none !important}');
        $view->registerJs($js, $view::POS_END);


    }
}
