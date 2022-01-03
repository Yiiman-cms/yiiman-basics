<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $this \yii\bootstrap\Widget
 */

namespace YiiMan\YiiBasics\modules\form\widgets;


use kartik\base\InputWidget;

use yii\bootstrap\Widget;

class FormGeneratorWidget extends InputWidget
{
    public function run()
    {
        // https://formbuilder.online/
        // https://formbuilder.online/docs/development/#install-dependencies
        $asset = FormGeneratorAssets::register($this->view);
        $details = '';

        $name = $this->model->formName();

        if (!empty($this->model->details)) {
            $details = 'formBuilder.actions.setData(`'.$this->model->details.'`);';
        }

        $js = <<<JS

  
  var formBuilder=$('#build-wrap').formBuilder(
      {
      i18n: {
    locale: 'fa-IR',
    location: '{$asset->baseUrl}/langs',
    extension: '.lang'
    //override: {
    //    'en-US': {...}
    //}
  }
      }
  );
   

    $('button[type="submit"]').click(function(e){
        let formdata=formBuilder.actions.getData('json', true);
        $('#form-data{$name}').val(formdata);
        console.log(formBuilder.actions.getData('json', true));
        console.log($('#form-data{$name}'));
    });
    
    setTimeout(function(){
        $details
    },
    1000)
JS;
        $this->view->registerJs($js, $this->view::POS_END);

        echo '

<div id="build-wrap"></div>
<textarea style="display: none"  name="'.$name.'[details]" id="form-data'.$name.'"></textarea>

';
    }
}
