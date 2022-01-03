<?php


namespace YiiMan\YiiBasics\modules\widget\widgets;


use kartik\base\Widget;
use YiiMan\YiiBasics\lib\View;
use YiiMan\YiiBasics\modules\parameters\models\Parameters;
use YiiMan\YiiBasics\modules\widget\models\Components;
use system\widgets\TippyTooltip\TippyWidget;

class BlockWidget extends Widget
{
    public function run()
    {

        $layoutUrl=\Yii::$app->urlManager->createUrl(['widget/default/layout']);
        $this->view->registerJs(<<<JS
        var layoutUrl=`{$layoutUrl}`;
      
JS
            , View::POS_HEAD);


        $contents = '';
        $out = '';

        if (!empty(Components::getAllComponents())) {

            $out .= '

<div class="row" style="
border: solid 1px rgba(0, 0, 0, 0.11);
border-radius: 5px;
margin: 10px 0;
padding: 10px;
">
    <div class="col-md-12">';
            $out .= '<h3 id="themeComponentsTitle">' . \Yii::t('widgets', 'کامپوننت های از قبل طراحی شده') . '</h3>';


            $out .= '<div id="themecomponents-continer" class="card card-nav-tabs withheader">';

            $out .= '<div class="card-header card-header-danger">';
            $out .= '<div class="nav-tabs-navigation">';
            $out .= '<div class="nav-tabs-wrapper">';
            $out .= '<ul class="nav nav-tabs" data-tabs="tabs">';
            $isfirstTab = true;
            foreach (Components::getAllComponents() as $cat) {
                $id = hash('crc32', $cat['name']);
                if ($isfirstTab) {
                    $cl = 'active show';
                    $isfirstTab = false;
                } else {
                    $cl = '';
                }
                $out .= <<<HTML
                            <li class="nav-item ">
                              <a class="nav-link {$cl}" href="#{$id}" data-toggle="tab">{$cat['name']}</a>
                            </li>
                    
HTML;


            }
            $out .= '</ul>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>';


            $out .= '<div class="card-body ">';
            $out .= '<div class="tab-content text-center">';
            $isfirstTab = true;
            foreach (Components::getAllComponents() as $cat) {

                $id = hash('crc32', $cat['name']);
                if ($isfirstTab) {
                    $cl = 'active';
                    $isfirstTab = false;
                } else {
                    $cl = '';
                }

                $out .= '<div class="tab-pane ' . $cl . '" id="' . $id . '">';
                $out .= '<div class="row">';
                foreach ($cat['items'] as $item) {
                    $out .= '<div class="col-md-4">';
                    $out .= '<h5 class="text-center">' . $item['label'] . '</h5>';

                    // < generate image >
                    {

                        // < Check Image >
                        {
                            $path = \Yii::$app->Options->UploadDir . '/pageBuilder/';
                            $pathURL = \Yii::$app->Options->UploadUrl . '/pageBuilder/';
                            if (!file_exists($path . $item['name'] . '.png')) {
                                @mkdir($path);
                                copy($item['image'], $path . $item['name'] . '.png');
                            }
                        }
                        // </ Check Image >


                        $imageContent = $pathURL . $item['name'] . '.png';


                        $out .= '<img data-content="' . $item['name'] . '" data-name="ttpComponent" class="img-raised rounded img-fluid" ' . TippyWidget::attribute($item['description']) . ' src="' . $imageContent . '">';
                    }
                    // </ generate image >

                    // < Generate Contents >
                    {
                        $c = file_get_contents($item['content']);
                        $contents .= 'var components_' . $item['name'] . '=`' . $c . '`;';
                    }
                    // </ Generate Contents >

                    $out .= '</div>';
                }
                $out .= '</div>';
                $out .= '</div>';

            }
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>';


            $out .= '</div></div>';
            $this->view->registerJs($contents, View::POS_HEAD);
            $this->view->registerJs($this->render('script/app.js'), View::POS_END);
            $this->view->registerCss(<<<CSS

CSS
            );

        }
        return $out;
    }


}
