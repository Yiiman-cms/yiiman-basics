<?php


namespace YiiMan\YiiBasics\widgets\CodeMirror;


use kartik\base\InputWidget;
use YiiMan\YiiBasics\lib\View;

use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\YiiBasics\modules\parameters\models\Parameters;
use YiiMan\YiiBasics\modules\widget\widgets\BlockWidget;
use YiiMan\YiiBasics\modules\parameters\widgets\ParameterWidget;
use YiiMan\YiiBasics\widgets\editarea\EditareaAssets;
use YiiMan\YiiBasics\widgets\TippyTooltip\TippyWidget;
use yii\helpers\Html;

class CodeMirrorWidget extends InputWidget
{

    const MODE_HTML_MIXED = 'htmlmixed/htmlmixed.js';
    const MODE_HTML_EMBEDDED = 'htmlembedded/htmlembedded.js';
    const MODE_JAVASCRIPT = 'javascript/javascript.js';
    const MODE_MARKDOWN = 'markdown/markdown.js';
    const MODE_PHP = 'php/php.js';
    const MODE_CSS = 'css/css.js';

    public $modes = ['htmlmixed/htmlmixed.js'];

    public function run()
    {

        $translateUrl=\Yii::$app->urlManager->createUrl(['/language/default/translate']);
        $parameterValueUrl=\Yii::$app->urlManager->createUrl(['/parameters/default/filter']);
        $parameterValueAddUrl=\Yii::$app->urlManager->createUrl(['/parameters/default/ajax-add']);
        if (!empty($this->model->language)){
            $language=Language::findOne($this->model->language);
            $lang=strtolower( $language->shortCode);
        }else{
            $lang=strtolower( \Yii::$app->language);
        }
        $this->view->registerCssFile('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        $js = <<<JS
var parameterValueAddUrl='$parameterValueAddUrl';
var editorMirror;

    
      var nonEmpty = false;
          
       CodeMirror.commands.autocomplete = function(cm) {
            cm.showHint({hint: CodeMirror.hint.anyword});
       }
      
   
   
   
   
   
     editorMirror = CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
      mode: "application/xml",
      styleActiveLine: true,
      lineNumbers: true,
      lineWrapping: true,
      theme:'isotope',
      autoCloseBrackets: true,
      autoCloseTags: true,
      foldGutter: true,
      viewportMargin: Infinity,
      lint: true,
      gutters: ["CodeMirror-linenumbers", "breakpoints"],
      profile: ['html','css','javascript'],
      extraKeys: 
      {
          "Ctrl-Space": "autocomplete",
          "Ctrl-Q": function(cm) { cm.wrapParagraph(cm.getCursor(), options); },
          "Alt-F": "findPersistent"
          },
      colorpicker : {
                        mode : 'edit'
                    }
    });
   
       
       var totalLines = editorMirror.lineCount();  
       editorMirror.autoFormatRange({line:0, ch:0}, {line:totalLines});
       
       
   // < Context Menu >
   {
       $.contextMenu({
            selector: '.CodeMirror.CodeMirror-wrap', 
            callback: function(key, options) {
                var m = "clicked: " + key;
                switch (key) {
                  case 'translate':
                      var text=editorMirror.getRange( editorMirror.getCursor(true), editorMirror.getCursor(false));
                         $.ajax({
                                    url:'$translateUrl',
                                    method:'get',
                                    data:
                                    {
                                      "source": "auto",
                                      "target": "$lang",
                                      "text": text
                                    },
                                    success:function(res){
                                        editorMirror.replaceRange(res,  editorMirror.getCursor(true),  editorMirror.getCursor(false), text);
                                    }
                                });                  
                  
                  break;
                  case 'rtl':
                      editorMirror.setOption("direction", 'rtl' );
                      break;
                  case 'ltr':
                      editorMirror.setOption("direction", 'ltr' );
                      break;
                  case 'delete':
                      editorMirror.setValue("");
                      editorMirror.clearHistory();
                      break;
                  case 'format':
                       CodeMirror.commands["selectAll"](editorMirror);
                       var range = { from: editorMirror.getCursor(true), to: editorMirror.getCursor(false) };
                       editorMirror.autoFormatRange(range.from, range.to);
                      break;
                  case 'showvalue':
                       var text=editorMirror.getRange( editorMirror.getCursor(true), editorMirror.getCursor(false));
                       $.ajax({
                                    url:'$parameterValueUrl',
                                    method:'post',
                                    data:
                                    {
                                      
                                      "text": text
                                    },
                                    success:function(res){
                                        sweetAlert("متن در سایت به این صورت نمایش داده میشود:",res);
                                    }
                                });     
                      
                      break;
                      
                  case 'createParam':
                      paramModal.start();
                      break;
                } 
            },
            items: {
                
                "createParam": {name: "ایجاد پارامتر", icon: "fa-bolt"},
                "sep1": "---------",
                "translate": {name: "ترجمه ی ماشینی", icon: "edit"},
                "showvalue": {name: "نمایش مقدار پارامتر", icon: "fa-address-card"},
                "sep2": "---------",
                "format": {name: "فرمت کد نوشته شده", icon: "fa-align-justify"},
                
                 rtl: {name: "راستچین",icon:"fa-outdent"},
                "ltr": {name: "چپ چین",icon:"fa-indent"},
                "delete": {name: "پاک کردن صفحه", icon: "delete"},
                "sep3": "---------",
                "quit": {name: "Quit", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });
       
   }
   // </ Context Menu >
   
   
   
   
   
   

   
   
   // < Mark Number >
   {
       editorMirror.on("gutterClick", function(cm, n) {
          var info = cm.lineInfo(n);
          cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
       });
       
        function makeMarker() {
            var marker = document.createElement("div");
            marker.style.color = "#822";
            marker.innerHTML = "●";
            return marker;
        }
   }
   // </ Mark Number >
   
   

        function toggleSelProp() {
          nonEmpty = !nonEmpty;
          editorMirror.setOption("styleActiveLine", {nonEmpty: nonEmpty});
          var label = nonEmpty ? 'Disable nonEmpty option' : 'Enable nonEmpty option';
          document.getElementById('toggleButton').innerText = label;
        }
        
    $('.form-group.field-pages-content.required').click();
   
JS;
        $asset = CodeMirrorAssets::register($this->view);
        $this->view->registerJs($js, View::POS_END);

        if (!empty($this->modes)) {
            foreach ($this->modes as $mode) {
                $this->view->registerJsFile($asset->baseUrl . '/mode/' . $mode, ['depends' => CodeMirrorAssets::className()]);
            }
        }


        $this->view->registerCss('
iframe {
    width: 100% !important;
}

');
        $out = '';


        // < Load Parameters >
        {
            if (class_exists('YiiMan\YiiBasics\modules\parameters\models\Parameters')) {
                $out .= ParameterWidget::widget(['view' => $this->view]);
            }
            if (class_exists('YiiMan\YiiBasics\modules\widget\widgets\BlockWidget')) {
                $out .= BlockWidget::widget(['view' => $this->view]);
            }
        }
        // </ Load Parameters >

        $out .= '<div class="row"><div class="col-md-12">';
        $out .= Html::textarea($this->name, $this->value, ['id' => $this->id]);
        $out .= '</div></div>';



        return $out;
    }
}
