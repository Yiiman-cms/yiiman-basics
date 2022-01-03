<?php
/**
 * View.php
 * @author Revin Roman http://phptime.ru
 */

namespace YiiMan\YiiBasics\lib;

use yii\base\InvalidCallException;
use yii\base\ViewContextInterface;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;

class View extends \yii\web\View
{

    /**
     * @var string path alias to web base
     */
    public $base_path = '@app/web';

    /**
     * @var string path alias to save minify result
     */
    public $minify_path = '@app/web/minify';

    /**
     * @var bool|string charset forcibly assign, otherwise will use all of the files found charset
     */
    public $force_charset = true;

    /**
     * @var bool whether to change @import on content
     */
    public $expand_imports = true;

    /**
     * @var int
     */
    public $css_linebreak_pos = 2048;

    /**
     * @var int chmod of minified file
     */
    public $file_mode = 0664;

    /**
     * @var array schemes that will be ignored during normalization url
     */
    public $schemas = ['//', 'http://', 'https://', 'ftp://'];

    public function init()
    {
        parent::init();

        $minify_path = $this->minify_path = \Yii::getAlias($this->minify_path);
        if (!file_exists($minify_path)) {
            FileHelper::createDirectory($minify_path);
        }

        if (!is_readable($minify_path)) {
            throw new \RuntimeException(\Yii::t('app', 'Directory for compressed assets is not readable.'));
        }

        if (!is_writable($minify_path)) {
            throw new \RuntimeException(\Yii::t('app', 'Directory for compressed assets is not writable.'));
        }
    }

    public function endPage($ajaxMode = false)
    {
        $this->trigger(self::EVENT_END_PAGE);

        $content = ob_get_clean();
        foreach (array_keys($this->assetBundles) as $bundle) {
            $this->registerAssetFiles($bundle);
        }


        echo strtr(
            $content,
            [
                self::PH_HEAD => $this->renderHeadHtml(),
                self::PH_BODY_BEGIN => $this->renderBodyBeginHtml(),
                self::PH_BODY_END => $this->renderBodyEndHtml($ajaxMode),
            ]
        );

        $this->clear();
    }

    protected function registerAssetFiles($name)
    {
        if (!isset($this->assetBundles[$name])) {
            return;
        }

        $bundle = $this->assetBundles[$name];
        if ($bundle) {
            foreach ($bundle->depends as $dep) {
                $this->registerAssetFiles($dep);
            }

            $bundle->registerAssetFiles($this);
        }

        unset($this->assetBundles[$name]);
    }



    /**
     * @return self
     */
    private function minifyJS()
    {
        if (!empty($this->jsFiles)) {
            $only_pos = [self::POS_END];
            $js_files = $this->jsFiles;
            foreach ($js_files as $position => $files) {
                if (false === in_array($position, $only_pos)) {
                    $this->jsFiles[$position] = [];
                    foreach ($files as $file => $html) {
                        $this->jsFiles[$position][$file] = Html::jsFile($file);
                    }
                } else {
                    $this->jsFiles[$position] = [];

                    $long_hash = '';
                    foreach ($files as $file => $html) {
                        $file = \Yii::getAlias($this->base_path) . $file;
                        $hash = sha1_file($file);
                        $long_hash .= $hash;
                    }

                    $js_minify_file = $this->minify_path . DIRECTORY_SEPARATOR . sha1($long_hash) . '.js';
                    if (!file_exists($js_minify_file)) {
                        $js = '';
                        foreach ($files as $file => $html) {
                            $file = \Yii::getAlias($this->base_path) . $file;
                            $js .= file_get_contents($file) . ';' . PHP_EOL;
                        }

                        $js = (new \JSMin($js))->min();

                        file_put_contents($js_minify_file, $js);
                        chmod($js_minify_file, $this->file_mode);
                    }

                    $js_file = str_replace(\Yii::getAlias($this->base_path), '', $js_minify_file);
                    $this->jsFiles[$position][$js_file] = Html::jsFile($js_file);
                }
            }
        }

        return $this;
    }

    private function getImportContent($url)
    {
        $result = null;

        if ('url(' === StringHelper::byteSubstr($url, 0, 4)) {
            $url = str_replace(['url(\'', 'url(', '\')', ')'], '', $url);

            if (StringHelper::byteSubstr($url, 0, 2) === '//')
                $url = preg_replace('|^//|', 'http://', $url, 1);

            if (!empty($url))
                $result = file_get_contents($url);
        }

        return $result;
    }


    /**
     * Finds the view file based on the given view name.
     * @param string $view the view name or the [path alias](guide:concept-aliases) of the view file. Please refer to [[render()]]
     * on how to specify this parameter.
     * @param object $context the context to be assigned to the view and can later be accessed via [[context]]
     * in the view. If the context implements [[ViewContextInterface]], it may also be used to locate
     * the view file corresponding to a relative view name.
     * @return string the view file path. Note that the file may not exist.
     * @throws InvalidCallException if a relative view name is given while there is no active context to
     * determine the corresponding view file.
     */
    protected function findViewFile($view, $context = null)
    {
        $language = \Yii::$app->language;

        if (strncmp($view, '@', 1) === 0) {
            // e.g. "@app/views/main"
            $file = \Yii::getAlias($view);
        } elseif (strncmp($view, '//', 2) === 0) {

            // e.g. "//layouts/main"
            $file = \Yii::$app->getViewPath() . DIRECTORY_SEPARATOR . ltrim($view, '/');
        } elseif (strncmp($view, '/', 1) === 0) {
            // e.g. "/site/index"
            if (\Yii::$app->controller !== null) {
                $file = \Yii::$app->controller->module->getViewPath() . DIRECTORY_SEPARATOR . ltrim($view, '/');
            } else {
                throw new InvalidCallException("Unable to locate view file for view '$view': no active controller.");
            }
        } elseif ($context instanceof ViewContextInterface) {
            if (realpath($context->getViewPath() . DIRECTORY_SEPARATOR . $language . DIRECTORY_SEPARATOR . $view)) {
                $file = $context->getViewPath() . DIRECTORY_SEPARATOR . $language . DIRECTORY_SEPARATOR . $view;
            } else {
                $file = $context->getViewPath() . DIRECTORY_SEPARATOR . $view;
            }

        } elseif (($currentViewFile = $this->getRequestedViewFile()) !== false) {
            $file = dirname($currentViewFile) . DIRECTORY_SEPARATOR . $view;
        } else {
            throw new InvalidCallException("Unable to resolve view file for view '$view': no active view context.");
        }

        if (pathinfo($file, PATHINFO_EXTENSION) !== '') {
            return $file;
        }
        $path = $file . '.' . $this->defaultExtension;
        if ($this->defaultExtension !== 'php' && !is_file($path)) {
            $path = $file . '.php';
        }

        return $path;
    }

}
