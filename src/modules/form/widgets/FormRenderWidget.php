<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\form\widgets;


use YiiMan\YiiBasics\modules\form\models\Form;
use yii\bootstrap\Widget;

class FormRenderWidget extends Widget
{
    public $id;

    public function run()
    {
        $model = Form::findOne($this->id);

        if (empty($model)) {
            return;
        }
        // https://formbuilder.online/
        // https://formbuilder.online/docs/development/#install-dependencies
        $asset = FormRenderAssets::register($this->view);
        $details = '';


        $js = <<<JS

  var code = document.getElementById("build-wrap-{$model->id}");
  var formData =
    `{$model->details}`;

  // Grab markup and escape it
  var markup = $("<div/>");
  markup.formRender({ formData });

  // set < code > innerText with escaped markup
  let html=markup.formRender("html");
  
  $(code).append(html); 

    
    
JS;
        $this->view->registerJs($js, $this->view::POS_END);

        echo '


<form enctype="multipart/form-data" action="'.\Yii::$app->urlManager->createUrl(['/form-save']).'" method="post" id="build-wrap-'.$model->id.'" style="display: block"  >
<input type="hidden" name="formId" value="'.$model->id.'" />
</form>

';
    }
}
